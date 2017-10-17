FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="varbase" \
    PROFILE="varbase"

# RUN COMPOSER=composer.json composer create-project vardot/vardoc-project:^8.1.0-beta2 /var/www/${NEWDISTRO} --no-dev --no-interaction
# RUN rm -f /var/www/html && \
#     mv -f /var/www/${NEWDISTRO} /var/www/html

# Download distro (8.x) on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN rm -f /var/www/html/composer.lock /var/www/html/composer.json && \
    cp /var/www/html/profiles/${NEWDISTRO}/composer.json /var/www/html/composer.json

# Install dependencies
RUN COMPOSER=composer.json composer install --no-dev
RUN COMPOSER=composer.json composer clear-cache

RUN sed -i 's/2000000/'"0"'/g' /var/www/html/sites/default/default.services.yml

# Download ace library
# RUN wget -q https://github.com/ajaxorg/ace-builds/archive/v1.2.8.tar.gz && \
#     tar xvf v1.2.8.tar.gz -C /var/www/html/libraries && \
#     rm /var/www/html/v1.2.8.tar.gz && \
#     mv /var/www/html/libraries/ace-builds-1.2.8 /var/www/html/libraries/ace

# Install Drupal
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
