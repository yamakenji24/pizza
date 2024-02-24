FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    openssl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PDO MySQL driver
RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY ../../composer.json ../../composer.lock ./
RUN composer install
RUN composer dump-autoload

COPY ./ ./

# generate key
RUN if [ ! -f "./src/Adapter/Utility/rsa/secret_key.pem" ]; then \
    openssl genrsa -out ./src/Adapter/Utility/rsa/secret_key.pem 4096; \
    openssl rsa -in ./src/Adapter/Utility/rsa/secret_key.pem -out ./src/Adapter/Utility/rsa/pub_key.pem -outform PEM -pubout; \
    fi

EXPOSE 9000