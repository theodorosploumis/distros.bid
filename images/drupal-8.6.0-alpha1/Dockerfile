FROM drupal8/distros
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="drupal-8.6.0-alpha1" \
    PROFILE="standard"

# Download distro on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
RUN bash /var/www/install.sh
