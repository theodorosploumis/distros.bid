FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="openlucius" \
    VERSION="2.0.0-beta1" \
    PROFILE="openlucius"

# This is an installation from a composer template
RUN rm -rf /opt/drupal/

RUN COMPOSER=composer.json composer create-project lucius-digital/openlucius-project:2.0.0-beta1 /opt/drupal/ \
    --dev --quiet --no-ansi --no-interaction --no-progress


# Install Drupal
RUN bash /opt/install.sh

WORKDIR /opt/drupal/