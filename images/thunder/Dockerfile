FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="thunder"
    # RELEASE="2.9"

# Download distro (8.x) on html folder
RUN wget -q https://ftp.drupal.org/files/projects/thunder-8.x-2.9-core.tar.gz && \
    tar xvf thunder-8.x-2.9-core.tar.gz -C /var/www/ && \
    rm -r /var/www/html && \
    mv /var/www/thunder-8.x-2.9 /var/www/html

# Prepare installation and install
RUN bash /var/www/prepare-install.sh
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
