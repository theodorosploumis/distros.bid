FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="drutopia" \
    VERSION="2.0.0" \
    PROFILE="drutopia"

# This is an installation from a composer template
RUN COMPOSER=composer.json composer require drutopia/drutopia \
    --quiet --no-ansi --no-interaction --no-progress

RUN COMPOSER=composer.json composer require drush/drush  \
    --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /opt/install.sh

WORKDIR /opt/drupal/