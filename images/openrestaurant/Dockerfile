FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="openrestaurant" \
    VERSION="2.61" \
    PROFILE="openrestaurant"

RUN COMPOSER=composer.json composer require openrestaurant/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /var/www/install.sh

WORKDIR /var/www/html
