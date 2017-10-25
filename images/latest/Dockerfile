FROM ubuntu:16.04

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

# Setup environment
ENV DEBIAN_FRONTEND=noninteractive \
    DRUSH="8.1.12" \
    COMPOSER="1.4.2"

# Update sources
RUN apt-get update

# Install software
RUN apt-get -y install \
    apache2 \
    curl \
    wget \
    vim \
    git \
    bash-completion \
    unzip \
    mysql-client mysql-server

RUN apt-get -y install \
    php7.0 \
    php7.0-cli \
    php7.0-curl \
    php7.0-common \
    php7.0-mbstring \
    php7.0-gd \
    php7.0-intl \
    php7.0-xml \
    php7.0-json \
    php7.0-mysql \
    php7.0-mcrypt \
    php7.0-zip \
    libapache2-mod-php7.0

# Enable php mods
RUN phpenmod pdo_mysql && \
    a2enmod rewrite actions proxy_fcgi setenvif

# Clear apt-get lists
RUN apt-get clean && \
    apt-get autoremove && \
    rm -rf /var/lib/apt/lists/archive.*

# Install Adminer
RUN mkdir /usr/share/adminer && \
    wget -q "http://www.adminer.org/latest.php" -O /usr/share/adminer/latest.php && \
    ln -s /usr/share/adminer/latest.php /usr/share/adminer/adminer.php && \
    echo "Alias /adminer.php /usr/share/adminer/adminer.php" | tee /etc/apache2/conf-available/adminer.conf && \
    a2enconf adminer.conf

# Create database, user and password, all as "drupal"
RUN service mysql start && \
    mysql -u root -e "CREATE DATABASE drupal CHARACTER SET utf8 COLLATE utf8_general_ci" && \
    mysql -u root -e "GRANT ALL ON drupal.* to 'drupal' identified by 'drupal';"

# Apache2 settings
RUN echo '<Directory "/var/www/html">' >> /etc/apache2/apache2.conf && \
    echo 'AllowOverride All' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf && \
    echo "ServerName localhost" | tee /etc/apache2/conf-available/servername.conf

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

# Create sync folder
RUN mkdir -p /var/www/config/sync
RUN chown -R www-data:www-data /var/www/config

# Clear html folder
RUN rm -r /var/www/html/*

# Prepare installation
COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh

COPY . /var/www/

# Create user www-data and assign UID
RUN usermod -u 1000 www-data

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
