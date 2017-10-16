#!/usr/bin/env bash
# Prepare a Drupal site for installation

# Create setting.php file
echo -e ">> Create setting.php file"
cp /var/www/html/sites/default/default.settings.php /var/www/html/sites/default/settings.php
chmod 777 /var/www/html/sites/default/settings.php

# Alter settings.php
echo "\$settings['trusted_host_patterns'] = array('.',);" >> /var/www/html/sites/default/settings.php && \
echo "\$config_directories = array(CONFIG_SYNC_DIRECTORY => '/var/www/config/sync', CONFIG_STAGING_DIRECTORY => DRUPAL_ROOT . '/var/www/config/staging',);" >> /var/www/html/sites/default/settings.php && \
echo "ini_set('memory_limit', '384M');" >> /var/www/html/sites/default/settings.php

# Create public files folder
echo -e ">> Create public files folder"
mkdir /var/www/html/sites/default/files

# Change owner and mode of public files
echo -e ">> Change owner and mode of public files"
chown -R www-data:www-data /var/www/html/sites/default
chmod -R 777 /var/www/html/sites/default/files
chmod 644 /var/www/html/sites/default/default.settings.php
chmod 644 /var/www/html/sites/default/default.services.yml

echo -e ">> Drupal is ready for installation."
