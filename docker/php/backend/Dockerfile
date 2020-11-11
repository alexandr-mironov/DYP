FROM registry.gitlab-e.artepay.ru/common/docker-php:0.2

#overwrite php.ini settings
ADD docker/php/php.ini /usr/local/etc/php/conf.d/40-custom.ini
# replace php-fpm config from docker-php:0.2 with config with actual socket filename
ADD docker/php/backend/zz.conf /usr/local/etc/php-fpm.d/zz-docker.conf

#todo need to add intl extension, thats way i found
RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

COPY . /app
# Указываем рабочую директорию для PHP
WORKDIR /app

CMD ["php-fpm"]