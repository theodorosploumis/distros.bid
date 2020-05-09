FROM ubuntu:20.04

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

# Setup environment
ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER="1.9.2"

# Install software
RUN apt-get -y install \
    apache2 \
    curl \
    wget \
    git \
    vim \
    unzip \
    php \
    php-cli \
    php-curl \
    php-common \
    php-mbstring \
    php-gd \
    php-intl \
    php-xml \
    php-json \
    php-zip \
    php-sqlite3 \
    libapache2-mod-php

RUN apt-get clean && \
    apt-get autoremove && \
    rm -rf /var/lib/apt/lists/archive.*

# Enable php mods
RUN a2enmod rewrite actions proxy_fcgi setenvif

# Copy several scrips
COPY terminal.php database.php install.sh /var/www/

# Apache2 settings
RUN echo '<Directory "/var/www/html">' >> /etc/apache2/apache2.conf && \
    echo 'AllowOverride All' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf && \
    echo "ServerName localhost" | tee /etc/apache2/conf-available/servername.conf

# Install Composer
RUN wget -q https://github.com/composer/composer/releases/download/${COMPOSER}/composer.phar && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Create user www-data and assign UID
RUN usermod -u 1000 www-data

# Create sync folder
RUN mkdir -p /var/www/config/sync && \
    chown -R www-data:www-data /var/www/config

# Clear html folder
RUN rm -r /var/www/html/*

WORKDIR /var/www/html

EXPOSE 80