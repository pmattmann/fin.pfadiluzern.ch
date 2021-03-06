FROM php:7.4.15-apache

WORKDIR /app

RUN apt-get update
RUN apt-get install -y libicu-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl

RUN a2enmod rewrite
COPY apache-vhost.conf /etc/apache2/sites-enabled/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
