build: build-master

test: test-master

build-base:
	docker pull nickistre/ubuntu-lamp:14.04
	docker build -t drupal-distros/base:latest base

build-master: build-base
	docker build -t drupal-distros/base:latest images/base
	docker build -t drupal-distros/drupal:latst images/drupal
	docker build -t drupal-distros/lightning:latest images/lightning

test-master:
	@echo -n "base\t\t"
	@docker run drupal-distros/base:latest --version --no-ansi
	@echo -n "drupal\t\t"
	@docker run drupal-distros/drupal:latest --version --no-ansi
	@echo -n "lightning\t\t"
	@docker run drupal-distros/lightning:latest --version --no-ansi
