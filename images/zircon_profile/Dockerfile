FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="zircon_profile" \
    PROFILE="zircon_profile"

# Download distro (8.x) on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation and install
RUN bash /var/www/prepare-install.sh
RUN bash /var/www/install.sh
