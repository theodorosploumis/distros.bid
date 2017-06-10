FROM nickistre/ubuntu-lamp:14.04
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV DISTRO="drupal" \
    PROFILE="standard" \
    DRUSH="8.1.12" \
    COMPOSER="1.4.2"

# ENV DRUPALCONSOLE "1.0.0-beta1"

# Packages
# RUN apt-get update && \
#     DEBIAN_FRONTEND=noninteractive apt-get install -y \
#     git
#   && rm -r /var/lib/apt/lists/*

RUN rm -r /var/lib/apt/lists/*

# Install Composer
RUN wget -q https://github.com/composer/composer/releases/download/${COMPOSER}/composer.phar && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer && \
    composer --version

# Install Drush
RUN wget -q https://github.com/drush-ops/drush/releases/download/${DRUSH}/drush.phar && \
    chmod +x drush.phar && \
    mv drush.phar /usr/local/bin/drush && \
    drush --version

WORKDIR /var/www/html

# Download distro (8.x) on html folder
RUN rm -r /var/www/html/index.html && \
    drush dl ${DISTRO} --destination=/var/www --drupal-project-rename=html -y

# Prepare installation
COPY prepare-install.sh /var/www/html/
RUN bash prepare-install.sh

# Install drupal-console inside drupal site root
# RUN curl --silent https://drupalconsole.com/installer -L -o drupal.phar && \
#     mv drupal.phar /usr/local/bin/drupal && \
#     chmod +x /usr/local/bin/drupal && \
#     drupal --version

# Install drupal-console globally
# RUN composer clearcache && \
#     composer global require drupal/console:@stable && \
#     drupal --version

# Create database, user and password, all as "drupal"
RUN service mysql start && \
    mysql -u root -e "CREATE DATABASE drupal CHARACTER SET utf8 COLLATE utf8_general_ci" && \
    mysql -u root -e "GRANT ALL ON drupal.* to 'drupal' identified by 'drupal';"

# Enable mod_rewrite
RUN service apache2 start && \
    echo '<Directory "/var/www/html">' >> /etc/apache2/apache2.conf && \
    echo 'AllowOverride All' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf && \
    a2enmod rewrite

# Better settings for the site
RUN mkdir -p /var/www/config/sync && \
    mkdir -p /var/www/config/staging && \
    chown -R www-data:www-data /var/www/config

RUN echo "\n \$settings['trusted_host_patterns'] = array('.',);" >> /var/www/html/sites/default/settings.php && \
    echo "\n \$config_directories = array(\n CONFIG_SYNC_DIRECTORY =>  '/var/www/config/sync',\n CONFIG_STAGING_DIRECTORY => DRUPAL_ROOT . '/var/www/config/staging',);" >> /var/www/html/sites/default/settings.php && \
    echo "\n ini_set('memory_limit', '256M');" >> /var/www/html/sites/default/settings.php

RUN service mysql start && \
    service apache2 start && \
    drush site-install -y ${PROFILE} \
          --site-name="Distribution ${PROFILE} with Docker" \
          --db-url=mysql://drupal:drupal@localhost/drupal \
          --site-mail=admin@example.com \
          --account-name=admin \
          --account-pass=admin \
          --account-mail=admin@example.com

# Assign all public files to www-data and assign UID
RUN usermod -u 1000 www-data && \
    chown -R www-data:www-data /var/www/html

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]

ENTRYPOINT ["supervisord", "-c", "/etc/supervisord.conf", "--nodaemon"]
