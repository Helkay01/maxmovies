FROM php:8.2-cli

# Optional: install extensions like mysqli or pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy all your app files into the container
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Expose the port Render will use
EXPOSE 10000

# Start the built-in PHP server
CMD ["php", "-S", "0.0.0.0:10000", "-t", ".", "router.php"]
