FROM drupal8/distros:base

MAINTAINER Theodoros Ploumis - www.theodorosploumis.com

ENV NEWDISTRO="druppio_small_business_distribution" \
    PROFILE="druppio_small_business_distribution"

# Download distro (8.x) on html folder
RUN drush dl ${NEWDISTRO} -y --destination=/var/www --drupal-project-rename=html

# Install extra libraries
# RUN wget -q https://github.com/sachinchoolur/lightGallery/archive/1.6.3.tar.gz && \
#     tar -xzf 1.6.3.tar.gz -C libraries/ && \
#     rm -f 1.6.3.tar.gz && \
#     mv libraries/lightGallery-1.6.3 libraries/lightgallery
RUN cp profiles/${PROFILE}/libraries/lightgallery libraries/lightgallery

# Update mismatched entities
RUN drush entup -y

# Prepare installation and install
RUN bash /var/www/prepare-install.sh
RUN bash /var/www/install.sh

VOLUME  ["/var/lib/mysql", "/var/www/html", "/var/www/config"]
