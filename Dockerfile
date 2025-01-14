RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    libpq-dev \
    php8.1-cli \
    php8.1-mysqli \
    php8.1-xml \
    php8.1-mbstring \
    php8.1-tokenizer \
    php8.1-iconv \
    php8.1-imagick \
    php8.1-gd \
    && docker-php-ext-install -o /usr/local/lib/php/extensions/no -i mysqli iconv imagick gd

COPY . /var/www/html/SangamDashboard  # Replace 'your-app-name' with your actual app name

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
