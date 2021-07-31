FROM phpswoole/swoole:4.7-php8.0-alpine

RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl


COPY composer.json composer.lock /var/www/
RUN composer install --no-dev --no-scripts

COPY . /var/www/

RUN composer dumpautoload -o && \
    php artisan config:cache && \
    php artisan route:cache


EXPOSE 3000
CMD ["php", "artisan", "octane:start", "--host=0.0.0.0", "--port=3000"]