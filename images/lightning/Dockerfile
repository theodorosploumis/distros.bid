FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="lightning" \
    PROFILE="lightning" \
    DOCROOT="/var/www/html/docroot"

RUN COMPOSER=composer.json composer create-project acquia/lightning-project /var/www/${NEWDISTRO} \
    --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN rm -rf /var/www/html && \
    mv /var/www/${NEWDISTRO} /var/www/html

RUN sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/docroot"'/g' /etc/apache2/sites-available/000-default.conf

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN sed -i 's/2000000/'"0"'/g' /var/www/html/docroot/sites/default/default.services.yml

# Install Drupal
WORKDIR /var/www/html/docroot
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
