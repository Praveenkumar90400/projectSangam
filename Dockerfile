FROM php:8.2-apache

# Install necessary packages, including gd library
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
        git \
    && docker-php-ext-install pdo pdo_mysql mysqli zip gd
        

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-interaction

# Set working directory
WORKDIR /app

# Copy the rest of the project
COPY . .

# Set document root for Apache
WORKDIR /var/www/html

# Set the correct permissions and ownership
RUN chmod -R 755 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache

# Update Apache configuration to enable proper access
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
