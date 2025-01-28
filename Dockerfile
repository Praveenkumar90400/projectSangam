# Use an official PHP image as the base
FROM php:8.1-apache

# Install required PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        zip \
        unzip \
        curl \
        git && \
        
# install        
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-interaction

# Copy the rest of the project
COPY . .

# Set document root for Apache
WORKDIR /var/www/html

# Ensure public directory exists
RUN mkdir -p /var/www/html/public

# Set the correct permissions and ownership
RUN chmod -R 755 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Update Apache configuration to enable proper access
RUN echo "<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
