# Stage 1: Build (dependencies)
FROM php:8.2-cli AS builder

# Install necessary packages and PHP extensions for the build stage
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        libpng-dev \
        libonig-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libmcrypt-dev \
        libicu-dev \
        curl \
        git && \
    docker-php-ext-install \
        gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY composer.json composer.lock ./

# Install dependencies without dev dependencies for production
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Stage 2: Runtime (application)
FROM php:8.2-apache

# Copy the vendor directory from the builder stage
COPY --from=builder /app/vendor /var/www/html/vendor

# Copy the application files to the container
COPY . /var/www/html

# Install necessary PHP extensions for the runtime stage
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        libpng-dev \
        libonig-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libmcrypt-dev \
        libicu-dev \
        curl \
        git && \
    docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
        intl \
        gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite headers

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Update Apache configuration to point to the public directory and set ServerName
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog \${APACHE_LOG_DIR}/error.log\n\
    CustomLog \${APACHE_LOG_DIR}/access.log combined\n\
    ServerName localhost\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf && \
    apache2ctl configtest

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
