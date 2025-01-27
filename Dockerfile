# Use PHP 8.1 with Apache as the base image
FROM php:8.1-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install system dependencies, PHP extensions, and Composer
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    tokenizer \
    xml \
    zip \
    gd

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files to the container
COPY . /var/www/html

# Set permissions for Laravel's storage and cache directories
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Set the correct Apache DocumentRoot to Laravel's public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/|/var/www/html/public|g' /etc/apache2/apache2.conf

# Expose port 80 for the Apache server
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
