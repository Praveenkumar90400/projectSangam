# Use the official PHP image with Apache
FROM php:8.1-apache

# Set environment variables
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the application's source code into the container
COPY ./your-laravel-app/ .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies using Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy the Apache virtual host configuration
COPY ./config/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set proper permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the port on which the app will run
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
