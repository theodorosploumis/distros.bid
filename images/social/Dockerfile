FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="social" \
    PROFILE="social"

# Download distro (8.x) on html folder
# RUN wget -q https://ftp.drupal.org/files/projects/social-8.x-1.5-core.tar.gz && \
#     tar xvf social-8.x-1.5-core.tar.gz -C /var/www/ && \
#     rm -r /var/www/html && \
#     mv /var/www/social-8.x-1.5 /var/www/html

# COMPOSER=composer.json composer create-project goalgorilla/social_template:dev-master /var/www/html --no-interaction && \
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN rm -f /var/www/html/composer.lock /var/www/html/composer.json && \
    cp /var/www/html/profiles/${NEWDISTRO}/composer.json /var/www/html/composer.json

# Install dependencies
RUN COMPOSER=composer.json composer --quiet install && \
    composer clear-cache

# Install Drupal
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
