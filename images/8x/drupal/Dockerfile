FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="core-recommended" \
    VERSION="8.8.5" \
    PROFILE="standard"

RUN rm -rf /var/www/html

# Create Drupal project
RUN COMPOSER=composer.json composer require drush/drush:10.2.2
RUN COMPOSER=composer.json composer require drupal/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /var/www/install.sh

WORKDIR /var/www/html

