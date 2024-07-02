FROM php:8.2 as php

RUN apt-get update -y

# Install dependencies (apk instead of apt-get)
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libwebp-dev

#install gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp

#install gda

RUN docker-php-ext-install -j "$(nproc)" gd pdo pdo_mysql bcmath
WORKDIR /var/www
COPY . .

COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

ENV PORT=8000

RUN apt-get clean
RUN chmod +x docker/entrypoint.sh

ENTRYPOINT [ "docker/entrypoint.sh" ]