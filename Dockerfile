FROM php:7.4.24-apache
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
RUN apt-get update && \
     apt-get install -y \
         libzip-dev \
         && docker-php-ext-install zip