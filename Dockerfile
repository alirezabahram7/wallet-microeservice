FROM php:8.1-fpm-alpine

RUN apk --update --no-cache add \
    curl \
    libmcrypt-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    mysql-client \
    supervisor \
    zip \
    && docker-php-ext-install \
    bcmath \
    gd \
    mysqli \
    opcache \
    pdo \
    pdo_mysql \
    zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader

CMD php-fpm
