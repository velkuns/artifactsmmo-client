.PHONY: validate install update phpcs phpcbf phpmincompatibility phpmaxcompatibility phpstan analyze tests testdox ci clean

PHP_MIN_VERSION := "8.1"
PHP_MAX_VERSION := "8.3"
COMPOSER_BIN := composer

ifneq (,$(wildcard ./.env))
	include .env
	export
endif

define header =
    @if [ -t 1 ]; then printf "\n\e[37m\e[100m  \e[104m $(1) \e[0m\n"; else printf "\n### $(1)\n"; fi
endef

#~ Composer dependency
build: generator phpcsf

generator:
	$(call header,"Build new version of client, formatter & VO")
	@./bin/script generator --file="./data/openapi.json" --debug

#~ Composer dependency
validate:
	$(call header,Composer Validation)
	@${COMPOSER_BIN} validate

install:
	$(call header,Composer Install)
	@${COMPOSER_BIN} install

update:
	$(call header,Composer Update)
	@${COMPOSER_BIN} update
	@${COMPOSER_BIN} bump --dev-only

outdated:
	$(call header,Composer Outdated)
	@${COMPOSER_BIN} outdated --direct

composer.lock: install

#~ Vendor binaries dependencies
vendor/bin/php-cs-fixer:
vendor/bin/phpstan:
vendor/bin/phpunit:

#~ Report directories dependencies
build/reports/phpunit:
	@mkdir -p build/reports/phpunit

build/reports/phpstan:
	@mkdir -p build/reports/phpstan

#~ main commands
deps: composer.json # jenkins + manual
	$(call header,Checking Dependencies)
	@XDEBUG_MODE=off ./vendor/bin/composer-dependency-analyser --config=./ci/composer-dependency-analyser.php # for shadow & unused required dependencies
	@XDEBUG_MODE=off ./vendor/bin/composer-require-checker check # mainly for ext-* missing dependencies

phpcs: vendor/bin/php-cs-fixer # jenkins + manual
	$(call header,Checking Code Style)
	@XDEBUG_MODE=off ./vendor/bin/php-cs-fixer check -v --diff

phpcsf: vendor/bin/php-cs-fixer # manual
	$(call header,Fixing Code Style)
	@XDEBUG_MODE=off ./vendor/bin/php-cs-fixer fix -v

php-min-compatibility: vendor/bin/phpstan build/reports/phpstan # jenkins + manual
	$(call header,Checking PHP $(PHP_MIN_VERSION) compatibility)
	@XDEBUG_MODE=off ./vendor/bin/phpstan analyse --configuration=./ci/php-min-compatibility.neon --error-format=table

php-max-compatibility: vendor/bin/phpstan build/reports/phpstan # jenkins + manual
	$(call header,Checking PHP $(PHP_MAX_VERSION) compatibility)
	@XDEBUG_MODE=off ./vendor/bin/phpstan analyse --configuration=./ci/php-max-compatibility.neon --error-format=table

phpstan: vendor/bin/phpstan build/reports/phpstan # jenkins
	$(call header,Running Static Analyze)
	@XDEBUG_MODE=off ./vendor/bin/phpstan analyse --error-format=checkstyle > ./build/reports/phpstan/phpstan.xml

analyze: vendor/bin/phpstan build/reports/phpstan # manual
	$(call header,Running Static Analyze - Pretty tty format)
	@XDEBUG_MODE=off ./vendor/bin/phpstan analyse --error-format=table

tests: vendor/bin/phpunit build/reports/phpunit # jenkins + manual
	$(call header,Running Unit Tests)
	@XDEBUG_MODE=coverage php -dzend_extension=xdebug.so ./vendor/bin/phpunit --testsuite=unit --coverage-clover=./build/reports/phpunit/clover.xml --log-junit=./build/reports/phpunit/unit.xml --coverage-php=./build/reports/phpunit/unit.cov --coverage-html=./build/reports/coverage/ --fail-on-warning

integration: vendor/bin/phpunit build/reports/phpunit # manual
	$(call header,Running Integration Tests)
	@XDEBUG_MODE=coverage php -dzend_extension=xdebug.so ./vendor/bin/phpunit --testsuite=integration --fail-on-warning

testdox: vendor/bin/phpunit # manual
	$(call header,Running Unit Tests (Pretty format))
	@XDEBUG_MODE=coverage php -dzend_extension=xdebug.so ./vendor/bin/phpunit --testsuite=unit --fail-on-warning --testdox

clean: # manual
	$(call header,Cleaning previous build)
	@if [ "$(shell ls -A ./build)" ]; then rm -rf ./build/*; fi; echo " done"

ci: clean validate deps phpcs tests php-min-compatibility php-max-compatibility analyze
