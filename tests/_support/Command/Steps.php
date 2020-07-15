<?php

namespace Command;

use \Codeception\CustomCommandInterface;
use \Codeception\Test\Loader\Gherkin;
use Codeception\Util\Annotation;
use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Output\OutputInterface;

/**
 * Prints all steps from all Gherkin contexts for a specific suite
 * Extended `gherkin:steps` to categorize steps and print examples
 *
 * ```
 * codecept p4:steps acceptance
 * ```
 *
 */
class Steps extends Command implements CustomCommandInterface
{
    use \Codeception\Command\Shared\Config;
    use \Codeception\Command\Shared\Style;

    /**
     * returns the name of the command
     *
     * @return string
     */
    public static function getCommandName(): string
    {
        return "p4:steps";
    }

    /**
     * Configures the current command.
     */
    protected function configure(): void
    {
        $this->setDefinition(
            [
                new InputArgument('suite', InputArgument::REQUIRED, 'suite to scan for feature files'),
                new InputOption('config', 'c', InputOption::VALUE_OPTIONAL, 'Use custom path for config'),
                new InputOption('implementation', 'i', InputOption::VALUE_NONE, 'Display implementation'),
            ]
        );
        parent::configure();
    }

    /**
     * Returns the description for the command.
     *
     * @return string The description for the command
     */
    public function getDescription(): string
    {
        return 'Listing P4 steps';
    }

    /**
     * Displays a list of implemented steps
     *
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {

        $this->addStyles($output);
        $suite = $input->getArgument('suite');
        $config = $this->getSuiteConfig($suite);
        $config['describe_steps'] = true;
        $implementation = $input->getOption('implementation');

        $loader = new Gherkin($config);
        $steps = $loader->getSteps();

        $colspan = ['colspan' => $implementation ? 3 : 2];
        $prevClass = null;
        foreach ($steps as $name => $context) {
            $table = new Table($output);
            $table->setHeaders($implementation
                ? ['Step', 'Examples', 'Implementation']
                : ['Step', 'Examples']
            );
            $output->writeln("Steps from <bold>$name</bold> context:");
        
            foreach ($context as $step => $callable) {
                if (count($callable) < 2) {
                    continue;
                }

                [$class, $method] = $callable;
                if ($class !== $prevClass) {
                    $this->addClassheader($table, $class, $colspan, null !== $prevClass);
                    $prevClass = $class;
                }

                $methodAnnotation = Annotation::forMethod($class, $method);
                $examples = $methodAnnotation->fetchAll('example');
                $method = $class . '::' . $method;

                $implementation
                    ? $table->addRow([$step, implode("\n", $examples), $method])
                    : $table->addRow([$step, implode("\n", $examples)]);
            }
            $table->render();
        }

        if (!isset($table)) {
            $output->writeln("No steps are defined, start creating them by running <bold>gherkin:snippets</bold>");
        }

        return self::SUCCESS;
    }

    private function addClassheader(
        Table $table,
        string $class,
        array $attrs,
        bool $addTopSeparator
    ): void {
        if ($addTopSeparator) {
            $table->addRow([new TableSeparator($attrs)]);
        }

        $classComments = (new \ReflectionClass($class))->getDocComment();
        preg_match_all('/ \* (.*)/', $classComments, $matches);

        $table->addRows([
            [new TableCell(
                sprintf('<options=bold>%s</>', $matches[1][0] ?? $class),
                $attrs
            )],
            [new TableSeparator($attrs)]
        ]);
    }
}
