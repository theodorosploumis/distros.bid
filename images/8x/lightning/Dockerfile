FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="lightning" \
    VERSION="4.103" \
    PROFILE="lightning"

RUN COMPOSER=composer.json composer require drupal/${DISTRO}:${VERSION} --quiet --no-ansi --no-interaction --no-progress

RUN sed -i 's/2000000/'"0"'/g' /var/www/html/sites/default/default.services.yml

# Install Drupal
RUN bash /var/www/install.sh

WORKDIR /var/www/html
