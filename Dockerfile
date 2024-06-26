FROM php:8.2 as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev libpng-dev libwebp-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

#install gd

RUN docker-php-ext-install gd
RUN docker-php-ext-configure gd --with-webp
#install gd

WORKDIR /var/www
COPY . .

COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

ENV PORT=8000

ENTRYPOINT [ "docker/entrypoint.sh" ]