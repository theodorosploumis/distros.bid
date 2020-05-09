FROM drupal8/distros:latest-sqlite

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="drupal-8.8.5" \
    PROFILE="demo_umami"

# Download distro on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Install composer dependencies
RUN COMPOSER=composer.json composer install --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN COMPOSER=composer.json composer require drush/drush:^10.0 --quiet --no-ansi --no-interaction --no-progress

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
RUN bash /var/www/install-sqlite.sh
