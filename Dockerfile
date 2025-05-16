FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules and PHP extensions
RUN a2enmod rewrite headers
RUN docker-php-ext-install pdo pdo_mysql zip

# Create and set the working directory
WORKDIR /var/www/html

# Copy Apache configuration (ensure this file exists in your docker/ directory)
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Copy application files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Enable the site configuration
RUN a2ensite 000-default.conf

# Expose port (Render.com will use $PORT environment variable)
EXPOSE 8080

# Apache startup script
COPY docker/start-apache.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/start-apache.sh
CMD ["start-apache.sh"]
