FROM php:8.2-apache-fpm AS builder

# Set working directory
WORKDIR /app

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-interaction --no-ansi --no-progress

# Copy the rest of the application code
COPY . .

FROM php:8.2-apache-fpm

# Set working directory
WORKDIR /var/www/html

# Copy files from the builder stage
COPY --from=builder /app/ /var/www/html/

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for Laravel/Blade
RUN a2enmod rewrite

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \ 
    && chmod -R 770 /var/www/html/storage /var/www/html/bootstrap/cache \ 
    && chmod -R g+w /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
