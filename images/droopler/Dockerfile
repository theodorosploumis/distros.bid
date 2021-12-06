FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="droopler" \
    VERSION="8.2.1" \
    PROFILE="droopler" \
    VENDOR="droptica"

RUN COMPOSER=composer.json COMPOSER_MEMORY_LIMIT=-1 composer require ${VENDOR}/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /var/www/install.sh

WORKDIR /var/www/html