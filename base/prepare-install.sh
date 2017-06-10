#!/usr/bin/env bash
# Prepare a Drupal site for installation

PROJECT_PATH="/var/www/html"

# Create setting.php file
echo -e ">> Create setting.php file"
cp "${PROJECT_PATH}"/sites/default/default.settings.php "${PROJECT_PATH}"/sites/default/settings.php
chmod 777 "${PROJECT_PATH}"/sites/default/settings.php

# Create public files folder
echo -e ">> Create public files folder"
mkdir "${PROJECT_PATH}"/sites/default/files

# Change owner and mode of public files
echo -e ">> Change owner and mode of public files"
chown -R www-data:www-data "${PROJECT_PATH}"/sites/default
chmod -R 777 "${PROJECT_PATH}"/sites/default/files
chmod 644 "${PROJECT_PATH}"/sites/default/default.settings.php
chmod 644 "${PROJECT_PATH}"/sites/default/default.services.yml

echo -e ">> Drupal is ready for installation."
