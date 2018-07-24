#!/usr/bin/env bash
# Install drush/drush

if [ -z ${DOCROOT} ]
  then
    DOCROOT="/var/www/html";
fi

cd ${DOCROOT} && \
   COMPOSER=composer.json composer install drush/drush --quiet --no-ansi --no-dev --no-interaction --no-progress

/bin/sh ${DOCROOT}/vendor/bin/drush init