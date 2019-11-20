FROM drupal8/distros
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="drupal-8.7.10" \
    PROFILE="demo_umami"

# Download distro on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Create database
RUN bash /var/www/create-database.sh

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
RUN bash /var/www/install.sh
