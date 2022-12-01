FROM composer:latest AS composer
COPY ./conf/composer.json /app/composer.json
RUN composer install --ignore-platform-reqs --no-scripts

FROM php:8.0-apache
WORKDIR /var/www/html/
RUN docker-php-ext-install mysqli && \
    a2enmod authn_dbd && \
    pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-enable redis && \
    apt-get update && \
    apt-get install -y libaprutil1-dbd-mysql
RUN apt-get install -y git && \
    apt-get install -y libpng-dev && \
    apt-get install -y zip unzip && \
    docker-php-ext-install gd
COPY --from=composer /app/vendor /var/www/html/vendor