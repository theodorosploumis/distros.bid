FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="social" \
    VERSION="12.4.5" \
    PROFILE="social"

# This is an installation from a composer template
RUN rm -f /opt/drupal/composer.json
RUN rm -f /opt/drupal/composer.lock

COPY composer.json /opt/drupal/composer.json

RUN COMPOSER=composer.json composer install \
    --quiet --no-ansi --no-interaction --no-progress

# Install Drupal
RUN bash /opt/install.sh

RUN drush en social_demo -y --quiet --no-ansi
RUN drush social-demo:add file user group topic event event_enrollment comment post like --quiet --no-ansi

WORKDIR /opt/drupal/