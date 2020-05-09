FROM drupal:apache

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

# Setup environment
ENV COMPOSER="1.9.2" \
    DRUSH="10.2.2"

# Install software
RUN apt-get update && \
    apt-get -y install \
    curl \
    wget \
    git \
    vim \
    unzip

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

RUN rm -rf /var/www/html

# Create Drupal project
RUN COMPOSER=composer.json composer init
RUN COMPOSER=composer.json composer require drupal/recommended-project:^8.8 --quiet --no-ansi --no-interaction --no-progress

RUN cat /var/www/html/composer.json

WORKDIR /var/www/html

# Install drush
RUN COMPOSER=composer.json composer require drush/drush:${DRUSH} --quiet --no-ansi --no-interaction --no-progress

EXPOSE 80