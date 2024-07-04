FROM node:18-alpine AS node

WORKDIR /var/www
COPY . .

RUN npm install
RUN npm run build

FROM composer:2.5.8 AS composer

WORKDIR /var/www
COPY --from=node /var/www/ . 

RUN composer install

FROM php:8.2-fpm AS php

RUN apt-get update -y

# Install dependencies
RUN apt-get install -y unzip libcurl4-gnutls-dev libpng-dev libjpeg-dev libzip-dev libwebp-dev

#install gd

# RUN apk update && \
#     apk upgrade && \
#     apk add --no-cache \
#         unzip \
#         zlib-dev \
#         libcurl \
#         libpng-dev \
#         libjpeg \
#         libzip \
#         libwebp-dev

RUN docker-php-ext-configure gd --enable-gd --with-jpeg --with-webp

#install gda

RUN docker-php-ext-install -j "$(nproc)" gd pdo pdo_mysql bcmath

WORKDIR /var/www

ENV PORT=8000

COPY --from=composer /var/www/ . 
RUN apt-get clean
RUN chmod +x docker/entrypoint.sh

ENTRYPOINT [ "docker/entrypoint.sh" ]