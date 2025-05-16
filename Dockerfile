FROM php:8.2-apache

# Enable required modules
RUN a2enmod rewrite


# Custom Apache configuration
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Copy application
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html
