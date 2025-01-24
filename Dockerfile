# Use an official PHP image as the base
FROM php:8.1-fpm

# Install necessary packages
RUN apt-get update && \
    apt-get install -y \
        unzip \
        libzip-dev \
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libgd-dev \
        libwebp-dev \
        libxpm-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libicu-dev \
        curl \
        git \
    && docker-php-ext-install pdo pdo_mysql mysqli zip gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install project dependencies
RUN composer install --no-interaction

# Set environment variables directly
ENV DB_HOST="my-db-server" \
    DB_DATABASE="Mysql" \
    DB_USERNAME="root" \
    DB_PASSWORD="root"

# Replace placeholders with your actual values above

# Expose port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
