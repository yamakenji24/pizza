FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY ../../composer.json ../../composer.lock ./
RUN composer install
RUN composer dump-autoload

COPY ./ ./

EXPOSE 9000