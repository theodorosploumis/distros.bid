FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="df" \
    PROFILE="df" \
    DOCROOT="/var/www/html/docroot" \
    PACKAGE="acquia/df-project"

RUN COMPOSER=composer.json composer create-project ${PACKAGE} /var/www/${NEWDISTRO} \
             --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN composer clear-cache

RUN rm -rf /var/www/html && \
mv /var/www/${NEWDISTRO} /var/www/html

RUN sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/docroot"'/g' /etc/apache2/sites-available/000-default.conf

# WORKDIR ${DOCROOT}
# RUN COMPOSER=composer.json composer require "commerceguys/intl: ~0.7" "commerceguys/addressing: ~1.0" "commerceguys/zone: ~1.0" "embed/embed: ~2.2"

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
WORKDIR ${DOCROOT}
RUN bash /var/www/install.sh
