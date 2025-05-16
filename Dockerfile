<<<<<<< HEAD
=======
# Use official PHP with Apache
>>>>>>> d93a62033ab4f52a076450e8e0cf9dbefb907725
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
<<<<<<< HEAD
    libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache modules
RUN a2enmod rewrite
=======
    libzip-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install zip curl pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache rewrite module and configure .htaccess support
RUN a2enmod rewrite && \
    sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
>>>>>>> d93a62033ab4f52a076450e8e0cf9dbefb907725

# Set working directory
WORKDIR /var/www/html

<<<<<<< HEAD
# Copy composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Install dependencies (dev dependencies only for development)
RUN composer install --no-dev --optimize-autoloader

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Configure Apache for Render.com
RUN echo "Listen ${PORT:-8080}" > /etc/apache2/ports.conf
=======
# Copy composer files first (for Docker cache optimization)
COPY composer.json composer.lock ./

# Install PHP dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy all application files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

# Configure Apache for Render.com's dynamic PORT
RUN echo "Listen ${PORT:-8080}" > /etc/apache2/ports.conf && \
    sed -i 's/:80>:80/:${PORT}:${PORT}/g' /etc/apache2/sites-available/000-default.conf

# Start Apache in foreground
>>>>>>> d93a62033ab4f52a076450e8e0cf9dbefb907725
CMD ["apache2-foreground"]
