# Use an official PHP image as the base
FROM php:8.2-fpm

# Set the working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
        libzip-dev \
        unzip \
        git \
        curl \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-interaction --optimize-autoloader

# Copy the application code
COPY . .

# Set permissions for Laravel storage and cache
RUN chmod -R 777 storage bootstrap/cache

# Set environment variables
ENV APP_ENV=production
ENV APP_KEY="base64:key-placeholder"
ENV APP_DEBUG=false
ENV APP_URL=http://localhost

# Expose the container port for PHP-FPM
EXPOSE 9000

# Define the command to run the application
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]
