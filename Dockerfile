FROM richarvey/nginx-php-fpm@sha256:fdaa086c82611024776048db9d1eec6324aa1058e1d867a15004c92d24df6187

WORKDIR /var/www/html

COPY ./assets .
COPY . .

RUN chown -R www-data:www-data /var/www/html