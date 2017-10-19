FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="openrestaurant" \
    PROFILE="openrestaurant" \
    DOCROOT="/var/www/html/web" \
    PACKAGE="openrestaurant/openrestaurant-project:2.2.0" \

RUN COMPOSER=composer.json composer create-project ${PACKAGE} /var/www/${NEWDISTRO} \
    --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN rm -rf /var/www/html && \
    mv /var/www/${NEWDISTRO} /var/www/html

RUN sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/web"'/g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/web"'/g' /etc/apache2/sites-enabled/000-default.conf && \
    service apache2 restart

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN sed -i 's/2000000/'"0"'/g' /var/www/html/web/sites/default/default.services.yml

# Install Drupal
WORKDIR ${DOCROOT}
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
