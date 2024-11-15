#!/usr/bin/env bash
# 1. Prepare a Drupal site for installation

if [ -z ${DOCROOT} ]
  then
    DOCROOT="/opt/drupal/web";
fi

# 2. Create public files folder and settings
echo -e ">> Create public, private files and libraries folders"
if [ ! -d ${DOCROOT}/sites/default/files ]
  then
    mkdir -p ${DOCROOT}/sites/default/files;
fi
chmod -R 777 ${DOCROOT}/sites/default

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

# Create settings.php file
echo -e ">> Create settings.php file"
cp /opt/settings.php ${DOCROOT}/sites/default/settings.php
chmod 777 ${DOCROOT}/sites/default/settings.php

# Install Packages
echo -e ">> Install composer packages"
COMPOSER=composer.json COMPOSER_MEMORY_LIMIT=-1 composer config allow-plugins true
echo -e ">> Drupal is ready for installation."

# Create config/sync folder
mkdir -p /opt/drupal/config/sync
chmod 777 /opt/drupal/config/sync

# 2. Install a Drupal site with Drush
/opt/drupal/vendor/bin/drush site:install -y ${PROFILE} \
      --root=${DOCROOT} \
      --site-name="${DISTRO} by Distros.bid" \
      --db-url="sqlite://../../opt/sqlite/.sqlite" \
      --site-mail=admin@example.com \
      --account-name=admin \
      --account-pass=admin \
      --account-mail=admin@example.com \
      --quiet --no-ansi --no-interaction

/opt/drupal/vendor/bin/drush status

# Assign all site files to www-data
chown -R www-data:www-data ${DOCROOT}/sites/default/files
chmod -R 777 ${DOCROOT}/sites/default/files

# Move terminal.php to docroot
cp /opt/terminal.php ${DOCROOT}/terminal.php

# Move SQLite database manager to docroot
cp /opt/database.php ${DOCROOT}/database.php

# Again change permissions and owner for the sqlite folder
chown -R :www-data /opt/sqlite
chmod -R 777 /opt/sqlite

# Reset settings.php
rm -f ${DOCROOT}/sites/default/settings.php
cp /opt/settings.php ${DOCROOT}/sites/default/settings.php
chmod 777 ${DOCROOT}/sites/default/settings.php

# Remove bad folders (?)
rm -rf ${DOCROOT}/opt
