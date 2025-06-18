FROM php:8.1-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    npm \
    && docker-php-ext-install \
        intl \
        mbstring \
        zip \
        pdo \
        pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer from the Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files into the container
COPY . .

# Optional: set file ownership to Apache user
RUN chown -R www-data:www-data /var/www/html