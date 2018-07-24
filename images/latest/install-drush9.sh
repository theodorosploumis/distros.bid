#!/usr/bin/env bash
# Install a Drupal site with Drush

if [ -z ${DOCROOT} ]
  then
    DOCROOT="/var/www/html";
fi


