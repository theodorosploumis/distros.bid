FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="drupal-8.8.5" \
    PROFILE="standard"

# Install drush
RUN bash /var/www/install-drush.sh

# Download distro on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Install Drupal
RUN bash /var/www/install.sh
