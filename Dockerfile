# Use a base image
FROM ubuntu:latest

# Set the working directory
WORKDIR /app

# Update package list and install required packages (including Git and PHP dependencies)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    php-cli \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Clone the application code from the Git repository
RUN git clone https://github.com/Praveenkumar90400/projectSangam.git

# Set the working directory to the cloned project
WORKDIR /app/projectSangam

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose the necessary port (if the Laravel application serves on a specific port)
EXPOSE 80

# Set the entry point
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
