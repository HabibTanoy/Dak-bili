FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y libpq-dev libpng-dev curl unzip zip git jq supervisor postgresql-client
RUN docker-php-ext-install pdo_pgsql && docker-php-ext-enable pdo_pgsql 

RUN apt-get install -y libxrender1
# RUN apt-get update
RUN apt-get install -y libfontconfig1 libxml2-dev && docker-php-ext-install soap && docker-php-ext-enable soap
RUN apt-get install -y \
         libzip-dev \
         && docker-php-ext-install zip

#install redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# GD
RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.2.2

RUN docker-php-ext-install sockets

COPY docker/app/supervisor.conf /etc/supervisor/conf.d/supervisor.conf
COPY docker/app/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/custom-php.ini /usr/local/etc/php/conf.d/
