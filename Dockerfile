FROM php:8.2-apache

# Enable required modules and configure case sensitivity
RUN a2enmod rewrite speling && \
    echo "CheckSpelling On" >> /etc/apache2/apache2.conf && \
    echo "CheckCaseOnly On" >> /etc/apache2/apache2.conf && \
    sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Install PHP extensions if needed
RUN docker-php-ext-install pdo pdo_mysql

# Copy application files
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

WORKDIR /var/www/html
EXPOSE 8080

# Configure Apache to use Render's PORT
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
CMD ["apache2-foreground"]
