FROM eboraas/apache-php:latest

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

RUN apt-get update -y && \
    apt-get install -y --force-yes wget vim

# Install Composer
RUN wget -q https://github.com/composer/composer/releases/download/1.4.2/composer.phar && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Install dependencies
WORKDIR /var/www/html
RUN rm -f index.html
COPY . /var/www/html
RUN COMPOSER=composer.json composer install --quiet --no-ansi --no-dev --no-interaction --no-progress

# Clear apt-get lists
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/archive.*