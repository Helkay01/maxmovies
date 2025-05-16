FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Change Apache config to allow .htaccess files
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copy all files
COPY . /var/www/html/

WORKDIR /var/www/html/

EXPOSE 80
