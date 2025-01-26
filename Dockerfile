# Use a base image
FROM ubuntu:latest

# Set the working directory
WORKDIR /app

# Update package list and install required packages (including Git)
RUN apt-get update && apt-get install -y \
    git \
    && rm -rf /var/lib/apt/lists/*

# Clone the application code from the Git repository
RUN git clone https://github.com/Praveenkumar90400/projectSangam.git

# Copy the application code to the document root (if needed)
 COPY projectSangam /var/www/html

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose the necessary port (if the Laravel application serves on a specific port)
EXPOSE 80

# Set the entry point (if required)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
