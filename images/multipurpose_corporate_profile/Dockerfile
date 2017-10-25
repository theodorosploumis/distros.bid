FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="multipurpose_corporate_profile" \
    PROFILE="multipurpose_corporate_profile"

# Download distro (8.x) on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install distro
RUN bash /var/www/install.sh
