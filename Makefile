build: build-master

test: test-master

build-base:
	docker build -t drupal-distros/base:base base

build-master: build-base
	docker build -t composer/composer:master master
	docker build -t composer/composer:master-alpine master/alpine
	docker build -t composer/composer:master-php5 master/php5
	docker build -t composer/composer:master-php5-alpine master/php5-alpine

test-master:
	@echo -n "master\t\t\t"
	@docker run composer/composer:master --version --no-ansi
	@echo -n "master-alpine\t\t"
	@docker run composer/composer:master-alpine --version --no-ansi
	@echo -n "master-php5\t\t"
	@docker run composer/composer:master-php5 --version --no-ansi
	@echo -n "master-php5-alpine\t"
	@docker run composer/composer:master-php5-alpine --version --no-ansi
