FROM drupal8/distros

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="rain" \
    PROFILE="rain" \
    DOCROOT="/var/www/html/docroot" \
    PACKAGE="acquia/lightning-project"

RUN git clone git@bitbucket.org:mediacurrent/drupal-project.git /var/www/${NEWDISTRO}

RUN cd /var/www/${NEWDISTRO} && COMPOSER=composer.json install \
    --quiet --no-ansi --no-dev --no-interaction --no-progress

RUN composer clear-cache

RUN rm -rf /var/www/html && \
    mv /var/www/${NEWDISTRO} /var/www/html

RUN sed -i 's/\/var\/www\/html/'"\/var\/www\/html\/docroot"'/g' /etc/apache2/sites-available/000-default.conf

# Prepare installation
RUN bash /var/www/prepare-install.sh

RUN sed -i 's/2000000/'"0"'/g' /var/www/html/docroot/sites/default/default.services.yml

WORKDIR ${DOCROOT}

# Install Drupal
RUN bash /var/www/install.sh