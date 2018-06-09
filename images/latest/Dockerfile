FROM ubuntu:16.04

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

# Setup environment
ENV DEBIAN_FRONTEND=noninteractive \
    DRUSH="8.1.15" \
    COMPOSER="1.5.2"

# Install software
RUN apt-get update && \
    apt-get -y install \
    apache2 \
    curl \
    wget \
    git \
    cron \
    vim-tiny \
    unzip \
    mysql-server \
    php7.1 \
    php7.1-cli \
    php7.1-curl \
    php7.1-common \
    php7.1-mbstring \
    php7.1-gd \
    php7.1-intl \
    php7.1-xml \
    php7.1-json \
    php7.1-mysql \
    php7.1-mcrypt \
    php7.1-zip \
    libapache2-mod-php7.1 && \
    apt-get clean && \
    apt-get autoremove && \
    rm -rf /var/lib/apt/lists/archive.*

# Enable php mods
RUN phpenmod pdo_mysql && \
    a2enmod rewrite actions proxy_fcgi setenvif

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
    mv composer.phar /usr/local/bin/composer

# Install Drush
RUN wget -q https://github.com/drush-ops/drush/releases/download/${DRUSH}/drush.phar && \
    chmod +x drush.phar && \
    mv drush.phar /usr/local/bin/drush

# Create user www-data and assign UID
RUN usermod -u 1000 www-data

# Create sync folder
RUN mkdir -p /var/www/config/sync && \
    chown -R www-data:www-data /var/www/config

# Clear html folder
RUN rm -r /var/www/html/*

# Enrtypoint script
COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh

# MySQL settings/root/.my.cnf
#COPY my.cnf /root/.my.cnf

# Copy several scrips
COPY terminal.php install.sh prepare-install.sh /var/www/

# Setup cron job
#RUN crontab -l | { cat; echo "0 0 0 0 0 exit"; } | crontab -

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
