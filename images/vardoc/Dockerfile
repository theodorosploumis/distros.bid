FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="vardoc" \
    PROFILE="vardoc" \
    DOCROOT="/var/www/html/docroot" \
    PACKAGE="vardot/vardoc-project:^8.1.0-beta2"

RUN COMPOSER=composer.json composer create-project ${PACKAGE} /var/www/${NEWDISTRO} \
    --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN composer clear-cache

RUN rm -rf /var/www/html && \
    mv /var/www/${NEWDISTRO} /var/www/html

RUN sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/docroot"'/g' /etc/apache2/sites-available/000-default.conf

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Install Drupal
WORKDIR ${DOCROOT}
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
