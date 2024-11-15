FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="core-recommended" \
    VERSION="8.8.5" \
    PROFILE="demo_umami"

RUN COMPOSER=composer.json composer require drupal/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /var/www/install.sh

WORKDIR /var/www/html