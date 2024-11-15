FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="drutopia" \
    VERSION="1.18" \
    PROFILE="drutopia"

# This is an installation from a composer template
RUN rm -rf /opt/drupal/

RUN COMPOSER=composer.json composer create-project drutopia/drutopia_template:dev-master /opt/drupal/ \
    --no-install --quiet --no-ansi --no-interaction --no-progress

RUN COMPOSER=composer.json composer require drush/drush  \
    --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /opt/install.sh

WORKDIR /opt/drupal/