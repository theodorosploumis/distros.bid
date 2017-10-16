FROM nickistre/ubuntu-lamp:14.04
# FROM tutum/lamp:latest
# FROM fauria/lamp

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

# DEBIAN_FRONTEND=noninteractive \
ENV DRUSH="8.1.12" \
    COMPOSER="1.4.2"

# Packages
RUN apt-get -y update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get -y update && \
    apt-get install -y git

RUN apt-get install -y --force-yes \
    php5.6 php5.6-mbstring php5.6-mcrypt php5.6-mysql php5.6-xml php5.6-curl

RUN a2dismod php5 && \
    a2enmod php5.6

# Install Adminer
RUN mkdir /usr/share/adminer && \
    wget -q "http://www.adminer.org/latest.php" -O /usr/share/adminer/latest.php && \
    ln -s /usr/share/adminer/latest.php /usr/share/adminer/adminer.php && \
    echo "Alias /adminer.php /usr/share/adminer/adminer.php" | sudo tee /etc/apache2/conf-available/adminer.conf && \
    a2enconf adminer.conf

# Clear apt-get lists
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/archive.*

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

# Install Drupal Console Launcher
#RUN composer require drupal/console:~1.0 --prefer-dist --optimize-autoloader
# RUN curl --silent https://drupalconsole.com/installer -L -o drupal.phar && \
#     mv drupal.phar /usr/local/bin/drupal && \
#     chmod +x /usr/local/bin/drupal && \
#     drupal --version

# Better settings for the site
RUN mkdir -p /var/www/config/sync && \
    mkdir -p /var/www/config/staging && \
    chown -R www-data:www-data /var/www/config

# Set the current work dir
WORKDIR /var/www/html

# Download distro (8.x) on html folder
RUN rm -r /var/www/html/*

# Prepare installation
COPY prepare-install.sh /var/www/
COPY install.sh /var/www/

# Create user www-data and assign UID
RUN usermod -u 1000 www-data

# VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]

ENTRYPOINT ["supervisord", "-c", "/etc/supervisord.conf", "--nodaemon"]
