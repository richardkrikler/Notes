# docker build -t php_mysql-pdo .

FROM php:7.4.24-apache
RUN docker-php-ext-install pdo_mysql