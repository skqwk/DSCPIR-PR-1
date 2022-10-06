FROM php:8.0-apache
RUN apt-get update && apt-get install -y libaprutil1-dbd-mysql && a2enmod authn_dbd
RUN docker-php-ext-install mysqli