FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="druppio_small_business_distribution" \
    VERSION="1.57" \
    PROFILE="druppio_small_business_distribution"

RUN COMPOSER=composer.json composer require drupal/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /var/www/install.sh

WORKDIR /var/www/html