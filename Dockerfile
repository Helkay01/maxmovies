FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite && \
    a2enmod speling

# Configure Apache directory permissions
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Add case sensitivity configuration
RUN echo 'CheckSpelling On' >> /etc/apache2/apache2.conf && \
    echo 'CheckCaseOnly On' >> /etc/apache2/apache2.conf

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
