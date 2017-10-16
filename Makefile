build: build-master

test: test-master

build-base:
	docker pull nickistre/ubuntu-lamp:14.04
	docker build -t drupal8/distros:base images/base

build-master: build-base
	docker build -t drupal8/distros:drupal images/drupal
	docker build -t drupal8/distros:lightning images/lightning
	docker build -t drupal8/distros:thunder images/thunder
	docker build -t drupal8/distros:varbase images/varbase

test-master:
	@echo -n "base\t\t"
	@docker run drupal8/distros:base --version --no-ansi
	@echo -n "drupal\t\t"
	@docker run drupal8/distros:drupal --version --no-ansi
	@echo -n "lightning\t\t"
	@docker run drupal8/distros:lightning --version --no-ansi
	@echo -n "thunder\t\t"
	@docker run drupal8/distros:thunder --version --no-ansi
	@echo -n "varbase\t\t"
	@docker run drupal8/distros:varbase --version --no-ansi
