FROM php:7.0-cli

RUN apt-get update && apt-get upgrade -y \
        libzip-dev \
        libxml2-dev \
        bash \
        git \
        unzip \
        zip

RUN docker-php-ext-install bcmath mbstring zip xml

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

WORKDIR /var/www