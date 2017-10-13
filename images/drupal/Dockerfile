FROM drupal-distros/base:latest
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="drupal" \
    PROFILE="standard"

# Packages
# RUN apt-get update && \
#     DEBIAN_FRONTEND=noninteractive apt-get install -y \
#     git
#   && rm -r /var/lib/apt/lists/*

# Download distro (8.x) on html folder
RUN drush dl ${DISTRO} --destination=/var/www --drupal-project-rename=html -y

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN echo "\n \$settings['trusted_host_patterns'] = array('.',);" >> /var/www/html/sites/default/settings.php && \
    echo "\n \$config_directories = array(\n CONFIG_SYNC_DIRECTORY =>  '/var/www/config/sync',\n CONFIG_STAGING_DIRECTORY => DRUPAL_ROOT . '/var/www/config/staging',);" >> /var/www/html/sites/default/settings.php && \
    echo "\n ini_set('memory_limit', '256M');" >> /var/www/html/sites/default/settings.php

RUN service mysql start && \
    service apache2 start && \
    drush site-install -y ${PROFILE} \
          --site-name="Distribution ${PROFILE} with Docker" \
          --db-url=mysql://drupal:drupal@localhost/drupal \
          --site-mail=admin@example.com \
          --account-name=admin \
          --account-pass=admin \
          --account-mail=admin@example.com

# Change site name
RUN service mysql start && \
    drush config-set system.site name "Drupal version: $(drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Installation profile: ${PROFILE}" -y

# Assign all public files to www-data and assign UID
RUN chown -R www-data:www-data /var/www/html

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
