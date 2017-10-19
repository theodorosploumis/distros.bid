#!/usr/bin/env bash
# Prepare a Drupal site for installation

if [[ -z ${DOCROOT} ]]
  then
    DOCROOT="/var/www/html";
fi

# Create settings.php file
echo -e ">> Create settings.php file"
cp ${DOCROOT}/sites/default/default.settings.php ${DOCROOT}/sites/default/settings.php
chmod 777 ${DOCROOT}/sites/default/settings.php

# Alter settings.php
echo "\$settings['trusted_host_patterns'] = array('.',);" >> ${DOCROOT}/sites/default/settings.php && \
echo "\$config_directories = array(CONFIG_SYNC_DIRECTORY => '/var/www/config/sync', CONFIG_STAGING_DIRECTORY => DRUPAL_ROOT . '/var/www/config/staging',);" >> ${DOCROOT}/sites/default/settings.php && \
echo "ini_set('memory_limit', '256M');" >> ${DOCROOT}/sites/default/settings.php && \
echo "ini_set('max_execution_time', '1200');" >> ${DOCROOT}/sites/default/settings.php && \
echo "\$settings['file_private_path'] = '${DOCROOT}/sites/default/private-files';" >> ${DOCROOT}/sites/default/settings.php

# Create public files folder
echo -e ">> Create public, private files and libraries folders"
if [[ -z ${DOCROOT}/sites/default/files ]]
  then
    mkdir ${DOCROOT}/sites/default/files;
fi

if [[ -z ${DOCROOT}/libraries ]]
  then
    mkdir ${DOCROOT}/libraries;
fi

mkdir ${DOCROOT}/sites/default/private-files

# Change owner and mode of public files
echo -e ">> Change owner and mode of public files"
chown -R www-data:www-data ${DOCROOT}/sites/default
chmod -R 777 ${DOCROOT}/sites/default/files
chmod -R 777 ${DOCROOT}/libraries
chmod 644 ${DOCROOT}/sites/default/default.settings.php
chmod 644 ${DOCROOT}/sites/default/default.services.yml

echo -e ">> Drupal is ready for installation."
