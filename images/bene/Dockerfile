FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="bene" \
    PROFILE="bene" \
    DOCROOT="/var/www/html/web" \
    PACKAGE="thinkshout/bene-project:master"

RUN COMPOSER=composer.json composer create-project ${PACKAGE} /var/www/${NEWDISTRO} \
    --stability dev --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN composer clear-cache

RUN rm -rf /var/www/html && \
    mv /var/www/${NEWDISTRO} /var/www/html

RUN sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/web"'/g' /etc/apache2/sites-available/000-default.conf

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
WORKDIR ${DOCROOT}
RUN bash /var/www/install.sh
