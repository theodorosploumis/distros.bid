#!/usr/bin/env bash
# Install drush before doing anything else

if [ -z ${DOCROOT} ]
  then
    DOCROOT="/var/www/html";
fi

# Install drush
RUN COMPOSER=composer.json composer require drush/drush:10.2.2 --quiet --no-ansi --no-interaction --no-progress