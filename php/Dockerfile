FROM php:8.0.9-apache

RUN docker-php-ext-install opcache

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN sed -i "s/Listen 80/Listen 3000/" /etc/apache2/ports.conf && echo "FallbackResource /index.php" >> /etc/apache2/apache2.conf

COPY . /var/www/html

WORKDIR /var/www/html
