# infra/Dockerfile
FROM php:8.1-fpm-alpine

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN echo "memory_limit=256M" > /usr/local/etc/php/conf.d/docker-php-memlimit.ini

WORKDIR /var/www/html