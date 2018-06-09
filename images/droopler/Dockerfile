FROM drupal8/distros
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="droopler-8.x-1.1" \
    PROFILE="droopler"

# Download distro (8.x) on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Install missing packages
RUN COMPOSER=composer.json composer install --ignore-platform-reqs

RUN composer clear-cache

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
RUN bash /var/www/install.sh
