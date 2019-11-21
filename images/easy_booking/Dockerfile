FROM drupal8/distros:latest-sqlite
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="easy_booking-7.x-2.9" \
    PROFILE="easy_booking"

# Download distro (7.x) on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
RUN bash /var/www/install-sqlite.sh
