FROM php:8.2-apache

RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY . /var/www/html/

WORKDIR /var/www/html/

EXPOSE 80
