FROM drupal:php8.3-apache

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

# Setup environment
ENV COMPOSER="2.8.2"

# Install software
RUN apt-get update && \
    apt-get -y install \
    curl \
    wget \
    git \
    vim \
    unzip \
    sendmail \
    sqlite3

# Install common PHP packages
RUN docker-php-ext-install bcmath

# Remove and copy several scrips
# Workdir is /opt/drupal/
RUN rm -f /opt/drupal/composer.json
RUN rm -f /opt/drupal/composer.lock
COPY composer.json /opt/drupal
COPY terminal.php database.php install.sh composer.json settings.php /opt/

# Apache2 settings
RUN echo '<Directory "/opt/drupal/web">' >> /etc/apache2/apache2.conf && \
    echo 'AllowOverride All' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf && \
    echo "ServerName localhost" | tee /etc/apache2/conf-available/servername.conf

# Install Composer
RUN wget -q https://github.com/composer/composer/releases/download/${COMPOSER}/composer.phar && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Create user www-data and assign UID
RUN usermod -u 1000 www-data

# Create sqlite folder \
RUN mkdir -p /opt/sqlite && \
    chown -R :www-data /opt/sqlite && \
    chmod -R 777 /opt/sqlite

WORKDIR /opt/drupal/

EXPOSE 80