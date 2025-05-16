FROM php:8.2-apache

# Enable modules and configure Apache
RUN a2enmod rewrite && \
    a2enmod speling && \
    sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf && \
    { \
        echo 'CheckSpelling On'; \
        echo 'CheckCaseOnly On'; \
        echo 'RewriteMap lowercase int:tolower'; \
    } >> /etc/apache2/apache2.conf

# Install PHP extensions if needed
RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/
WORKDIR /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80
CMD ["apache2-foreground"]
