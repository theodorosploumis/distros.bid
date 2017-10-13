FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="lightning"
    # RELEASE="2.2.0"

# Download distro (8.x) on html folder
RUN wget -q https://github.com/acquia/lightning/releases/download/2.2.0/lightning-8.x-2.20.tar.gz && \
    tar xvf lightning-8.x-2.20.tar.gz -C /var/www/ && \
    rm -r /var/www/html && \
    mv /var/www/lightning-8.x-2.20 /var/www/html

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN echo "\n \$settings['trusted_host_patterns'] = array('.',);" >> /var/www/html/sites/default/settings.php && \
    echo "\n \$config_directories = array(\n CONFIG_SYNC_DIRECTORY =>  '/var/www/config/sync',\n CONFIG_STAGING_DIRECTORY => DRUPAL_ROOT . '/var/www/config/staging',);" >> /var/www/html/sites/default/settings.php && \
    echo "\n ini_set('memory_limit', '256M');" >> /var/www/html/sites/default/settings.php

RUN service mysql start && \
    service apache2 start && \
    drush site-install -y ${NEWDISTRO} \
          --site-name="Distribution ${NEWDISTRO} with Docker" \
          --db-url=mysql://drupal:drupal@localhost/drupal \
          --site-mail=admin@example.com \
          --account-name=admin \
          --account-pass=admin \
          --account-mail=admin@example.com

# Change site name
RUN service mysql start && \
    drush config-set system.site name "Drupal version: $(drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Installation profile: ${NEWDISTRO}" -y

# Assign all public files to www-data and assign UID
RUN chown -R www-data:www-data /var/www/html

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
