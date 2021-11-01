
# ============================================================================

# Check necessary commands exist

CIRCLECI := $(shell command -v circleci 2> /dev/null)
COMPOSER := $(shell command -v composer 2> /dev/null)
JQ := $(shell command -v jq 2> /dev/null)
SHELLCHECK := $(shell command -v shellcheck 2> /dev/null)
YAMLLINT := $(shell command -v yamllint 2> /dev/null)
FLAKE8 := $(shell command -v flake8 2> /dev/null)

# ============================================================================

lint: init
	@$(MAKE) -kj lint-sh lint-py lint-yaml lint-json lint-composer

init:
	@chmod 755 .githooks/*
	@find .git/hooks -type l -exec rm {} \;
	@find .githooks -type f -exec ln -sf ../../{} .git/hooks/ \;

# ============================================================================

lint-sh:
ifndef SHELLCHECK
	$(error "shellcheck is not installed: https://github.com/koalaman/shellcheck")
endif
	@find . -type f -name '*.sh' ! -path './tests/vendor/*' | xargs shellcheck

lint-py:
ifndef FLAKE8
	$(error "flake8 is not installed: https://pypi.org/project/flake8/")
endif
	@flake8

lint-yaml:
ifndef YAMLLINT
	$(error "yamllint is not installed: https://github.com/adrienverge/yamllint")
endif
	@find . -type f -name '*.yml' ! -path './tests/vendor/*' | xargs yamllint

lint-json:
ifndef JQ
	$(error "jq is not installed: https://stedolan.github.io/jq/download/")
endif
	@find . -type f -name '*.json' ! -path './tests/vendor/*' | xargs jq type | grep -q '"object"'

lint-composer:
ifndef COMPOSER
	$(error "composer is not installed: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos")
endif
	@find . -type f -name 'composer*.json' ! -path './tests/vendor/*' -exec composer validate {} \;
