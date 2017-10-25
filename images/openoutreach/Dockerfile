FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="openoutreach-7.x-1.43" \
    PROFILE="openoutreach"

# Download distro on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation and install
RUN bash /var/www/prepare-install.sh
RUN bash /var/www/install.sh
