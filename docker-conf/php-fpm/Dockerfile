# Dockerfile
FROM php:8.1-fpm

# Install any additional PHP extensions you need here
# RUN docker-php-ext-install ...
# Install Composer
## root user以外でcomposerを使うために必要
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY ../../composer.json ../../composer.lock ./
RUN composer install
RUN composer dump-autoload

COPY ./ ./

EXPOSE 9000