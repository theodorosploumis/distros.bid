FROM drupal:8.9-apache

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

# Setup environment
ENV COMPOSER="1.10.17"

# Install software
RUN apt-get update && \
    apt-get -y install \
    curl \
    wget \
    git \
    vim \
    unzip \
    sqlite3

# Copy several scrips
COPY terminal.php database.php install.sh composer.json /var/www/

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

RUN rm -rf /var/www/html

WORKDIR /var/www

EXPOSE 80