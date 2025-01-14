# Base image with Apache and PHP
FROM php:8.1-apache 

# Set working directory
WORKDIR /app

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-interaction --no-ansi --no-progress

# Copy the rest of the application code
COPY . .

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
