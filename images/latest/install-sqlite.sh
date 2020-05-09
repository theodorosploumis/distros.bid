#!/usr/bin/env bash
# Install a Drupal site with Drush

if [ -z ${DOCROOT} ]
  then
    DOCROOT="/var/www/html";
fi

# Install site
service apache2 start && \
drush site-install -y ${PROFILE} \
      --site-name="${NEWDISTRO} by Distros.bid" \
      --db-url=sqlite://sites/default/files/.ht.sqlite \
      --site-mail=admin@example.com \
      --account-name=admin \
      --account-pass=admin \
      --account-mail=admin@example.com

# Change site name
drush config-set system.site name "Drupal: $(drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Profile: ${NEWDISTRO}" -y
drush variable-set site_name "Drupal: $(drush pmi --fields=Version system | sed 's/\ Version   :  //g') - Profile: ${NEWDISTRO}" -y

# Assign all site files to www-data
chown -R www-data:www-data /var/www/html

# Move terminal.php to docroot
cp /var/www/terminal.php ${DOCROOT}/terminal.php

# Move phpliteadmin.php to docroot
cp /var/www/phpliteadmin.php ${DOCROOT}/phpliteadmin.php