FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl git inotify-tools libc-client-dev libkrb5-dev libicu-dev libzip-dev openjdk-17-jre-headless nano poppler-utils raptor2-utils unzip wget zip zlib1g-dev z3

RUN docker-php-ext-install iconv intl zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Load custom PHP config
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY ./includes/custom-php.ini "$PHP_INI_DIR/conf.d/custom.ini"

# adds user "mcon", adds him to group "www-data" and sets his home folder
# for more background information see:
# https://medium.com/@mccode/understanding-how-uid-and-gid-work-in-docker-containers-c37a01d01cf
#
# also use 1000 to make sure the active user outside of the container (you) and the mcon user inside can be treated the same
RUN mkdir /home/mcon
RUN useradd -r --home /home/mcon -u 1000 mcon
RUN usermod -a -G www-data mcon
RUN chown mcon:mcon -R /home/mcon

# set up Apache webserver
COPY ./includes/default.conf /etc/apache2/sites-enabled/000-default.conf
RUN rm -rf /var/www/html/*
RUN a2enmod rewrite
WORKDIR /var/www/html/

# add and set up script which is run after the container started
COPY ./includes/run.sh /run.sh
RUN chmod +x /run.sh

EXPOSE 80

CMD ["/run.sh"]
