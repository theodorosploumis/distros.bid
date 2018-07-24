FROM drupal8/distros
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV PROJECT="drupal/drupal" \
    NEWDISTRO="drupal-8.6.0-alpha1" \
    PROFILE="standard"

# Download distro (8.x) on html folder
RUN COMPOSER=composer.json composer create-project ${PROJECT} /var/www/html/ \
    --quiet --no-ansi --no-dev --no-interaction --no-progress

# Install drush as composer package
RUN COMPOSER=composer.json composer require drush/drush \
    --quiet --no-ansi --no-interaction --no-progress

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
RUN bash /var/www/install.sh
