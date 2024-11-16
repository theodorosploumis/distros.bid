FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="core-recommended" \
    VERSION="10.3.8" \
    PROFILE="standard"

# Create Drupal project
#RUN COMPOSER=composer.json composer config allow-plugins true
RUN COMPOSER=composer.json composer require drupal/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /opt/install.sh

WORKDIR /opt/drupal

