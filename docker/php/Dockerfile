FROM php:8.0-fpm

LABEL maintainer = 'Oguz Topcu <oguztopcu7@gmail.com>'

WORKDIR /var/www/app

RUN apt -y update

RUN apt -y install \
    vim

RUN docker-php-ext-install mysqli pdo pdo_mysql
