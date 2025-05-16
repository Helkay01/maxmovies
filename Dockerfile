FROM php:8.2-apache

# Enable mod_rewrite and configure case-insensitive matching
RUN a2enmod rewrite && \
    a2enmod speling && \  # Module for case-insensitive URL matching
    echo "CheckSpelling On" >> /etc/apache2/apache2.conf && \
    echo "CheckCaseOnly On" >> /etc/apache2/apache2.conf && \
    sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

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
