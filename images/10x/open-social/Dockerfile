FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="social" \
    VERSION="12.4.5" \
    PROFILE="social"

# This is an installation from a composer template
RUN COMPOSER=composer.json composer remove drupal/core-composer-scaffold
RUN COMPOSER=composer.json composer remove drupal/core-recommended
RUN COMPOSER=composer.json composer remove drush/drush

RUN COMPOSER=composer.json composer require goalgorilla/open_social:${VERSION}
    --quiet --no-ansi --no-interaction --no-progress \

RUN COMPOSER=composer.json composer require drush/drush  \
    --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /opt/install.sh

WORKDIR /opt/drupal/