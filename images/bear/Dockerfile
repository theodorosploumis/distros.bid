FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="bear" \
    PROFILE="bear" \
    DOCROOT="/var/www/html/docroot" \
    PACKAGE="zivtech/bear-project:8.2.x-dev"

RUN COMPOSER=composer.json composer create-project ${PACKAGE} /var/www/${NEWDISTRO} \
    --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN rm -rf /var/www/html && \
    mv /var/www/${NEWDISTRO} /var/www/html

RUN sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/docroot"'/g' /etc/apache2/sites-available/000-default.conf && \
    service apache2 reload

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
WORKDIR /var/www/html/docroot
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
