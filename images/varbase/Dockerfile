FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="varbase" \
    PROFILE="varbase"

# Download distro (8.x) on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN COMPOSER=composer.json composer install

RUN sed -i 's/2000000/'"0"'/g' /var/www/html/sites/default/default.services.yml

# Download ace library
# RUN wget -q https://github.com/ajaxorg/ace-builds/archive/v1.2.8.tar.gz && \
#     tar xvf v1.2.8.tar.gz -C /var/www/html/libraries && \
#     rm /var/www/html/v1.2.8.tar.gz && \
#     mv /var/www/html/libraries/ace-builds-1.2.8 /var/www/html/libraries/ace

# Install Drupal
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
