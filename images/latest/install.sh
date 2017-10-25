#!/usr/bin/env bash
# Install a Drupal site with Drush

# Install site
service mysql start && \
service apache2 start && \
drush site-install -y ${PROFILE} \
      --site-name="Distribution ${NEWDISTRO} with Docker" \
      --db-url=mysql://drupal:drupal@localhost/drupal \
      --site-mail=admin@example.com \
      --account-name=admin \
      --account-pass=admin \
      --account-mail=admin@example.com

# Change site name
service mysql start && \
drush config-set system.site name "Drupal version: $(drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Installation profile: ${NEWDISTRO}" -y
drush variable-set site_name "Drupal version: $(drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Installation profile: ${NEWDISTRO}" -y

# Assign all site files to www-data
chown -R www-data:www-data /var/www/html
