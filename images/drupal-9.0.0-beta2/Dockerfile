FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="drupal" \
    VERSION="9.0.0-beta2" \
    PROFILE="standard"

RUN COMPOSER=composer.json composer require drupal/recommended-project:${VERSION} --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /var/www/install.sh
