FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="core" \
    VERSION="8.8.5" \
    PROFILE="standard"

# Install drush
RUN bash /var/www/install-drush.sh

# Install Drupal
RUN bash /var/www/install.sh
