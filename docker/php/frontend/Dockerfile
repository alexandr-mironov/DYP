FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        curl \
        git \
        openssl \
        libssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install opcache \
    && docker-php-ext-install sockets \
    && docker-php-ext-install bcmath

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install pcntl

#overwrite php.ini settings
ADD docker/php/php.ini /usr/local/etc/php/conf.d/40-custom.ini
# replace php-fpm config from docker-php:0.2 with config with actual socket filename
ADD docker/php/frontend/zz.conf /usr/local/etc/php-fpm.d/zz-docker.conf

#todo need to add intl extension, thats way i found
#RUN apt-get -y update \
#&& apt-get install -y libicu-dev \
#&& docker-php-ext-configure intl \
#&& docker-php-ext-install intl

COPY . /app
# Указываем рабочую директорию для PHP
WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer.phar
#install dependencies
RUN php composer.phar i

RUN php requirements.php

ARG ENVIRONMENT
RUN php init --env=$ENVIRONMENT --overwrite=All

CMD ["php-fpm"]