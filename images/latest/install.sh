#!/usr/bin/env bash
# 1. Prepare a Drupal site for installation

if [ -z ${DOCROOT} ]
  then
    DOCROOT="/var/www/html";
fi

# Create settings.php file
echo -e ">> Create settings.php file"
cp ${DOCROOT}/sites/default/default.settings.php ${DOCROOT}/sites/default/settings.php
chmod 777 ${DOCROOT}/sites/default/settings.php

# Alter settings.php
echo "\$settings['trusted_host_patterns'] = array('.',);" >> ${DOCROOT}/sites/default/settings.php && \
echo "\$settings['config_sync_directory'] = '/var/www/config/sync',);" >> ${DOCROOT}/sites/default/settings.php && \
echo "ini_set('memory_limit', '256M');" >> ${DOCROOT}/sites/default/settings.php && \
echo "ini_set('max_execution_time', '1200');" >> ${DOCROOT}/sites/default/settings.php && \
echo "\$settings['file_private_path'] = '${DOCROOT}/sites/default/private-files';" >> ${DOCROOT}/sites/default/settings.php

# Create public files folder
echo -e ">> Create public, private files and libraries folders"
if [ ! -d ${DOCROOT}/sites/default/files ]
  then
    mkdir -p ${DOCROOT}/sites/default/files;
fi

if [ ! -d ${DOCROOT}/libraries ]
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

# 2. Install a Drupal site with Drush
service apache2 start && \
vendor/bin/drush site-install -y ${PROFILE} \
      --site-name="${DISTRO} by Distros.bid" \
      --db-url=sqlite://sites/default/files/.ht.sqlite \
      --site-mail=admin@example.com \
      --account-name=admin \
      --account-pass=admin \
      --account-mail=admin@example.com

# Change site name
vendor/bin/drush config-set system.site name "Drupal: $(vendor/bin/drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Profile: ${DISTRO}" -y
vendor/bin/drush variable-set site_name "Drupal: $(vendor/bin/drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Profile: ${DISTRO}" -y

# Assign all site files to www-data
chown -R www-data:www-data /var/www/html

# Move terminal.php to docroot
cp /var/www/terminal.php ${DOCROOT}/terminal.php

# Move SQLite database manager to docroot
cp /var/www/database.php ${DOCROOT}/database.php