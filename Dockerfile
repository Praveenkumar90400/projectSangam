# Base image with Apache and PHP
FROM php:8.1-apache  # Using php:8.1-apache instead of the non-existent image

# Set working directory
WORKDIR /app

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install dependencies (consider adding --prefer-dist for faster installs)
RUN composer install --no-interaction --no-ansi --no-progress --prefer-dist

# Copy the rest of the application code
COPY . .

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]

