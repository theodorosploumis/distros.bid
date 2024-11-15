FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="presto" \
    VERSION="2.2" \
    PROFILE="presto"

RUN COMPOSER=composer.json composer require drupal/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /var/www/install.sh

WORKDIR /var/www/html
