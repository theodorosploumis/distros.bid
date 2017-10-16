FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="varbase"
    # RELEASE="2.9"

# Download distro (8.x) on html folder
RUN wget -q https://ftp.drupal.org/files/projects/varbase-8.x-4.10-core.tar.gz && \
    tar xvf varbase-8.x-4.10-core.tar.gz -C /var/www/ && \
    rm -r /var/www/html && \
    mv /var/www/varbase-8.x-4.10 /var/www/html

# Prepare installation
RUN bash /var/www/prepare-install.sh

# Create private files folder
RUN mkdir /var/www/html/libraries /var/www/html/sites/default/private-files

# Alter setting.php for specific distribution
RUN echo "ini_set('memory_limit', '512M');" >> /var/www/html/sites/default/settings.php && \
    echo "ini_set('max_execution_time', '1200');" >> /var/www/html/sites/default/settings.php && \
    echo "\$settings['file_private_path'] = '/var/www/html/sites/default/private-files';" >> /var/www/html/sites/default/settings.php

RUN sed -i 's/2000000/'"0"'/g' /var/www/html/sites/default/default.services.yml

# Download ace library
RUN wget -q https://github.com/ajaxorg/ace-builds/archive/v1.2.8.tar.gz && \
    tar xvf v1.2.8.tar.gz -C /var/www/html/libraries && \
    rm /var/www/html/v1.2.8.tar.gz && \
    mv /var/www/html/libraries/ace-builds-1.2.8 /var/www/html/libraries/ace

# Install Drupal
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
