<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Wpunit extends \Codeception\Module
{

	public function _initialize($settings = [])
	{

		codecept_debug('Initialize wpunit suite');
		codecept_debug('Populate active plugins variable');

		$config = $this->getModule('WPLoader')->_getConfig();
		if ( ! isset($config['autoPopulatePlugins']) || 1!=$config['autoPopulatePlugins']) {
			codecept_debug('Auto Populate Plugins is not set. Skipping configuration of active plugins');
			return;
		}

		$cli = $this->getModule('WPCLI');
		$activePlugins = $cli->cliToArray('option get --quiet --allow-root --format=json active_plugins');

		$this->getModule( 'WPLoader' )->_reconfigure(
			[
				'plugins' => json_decode( end( $activePlugins ) )
			]
		);
		$config = $this->getModule('WPLoader')->_getConfig();
		codecept_debug($config);
		codecept_debug('Initialiazed wpunit suite');
	}
}
