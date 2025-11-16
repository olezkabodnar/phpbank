# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Copy package files
COPY package.json ./

# Install Node dependencies (including dev dependencies for build tools)
RUN npm install

# Copy application code
COPY . .

# Build frontend assets
RUN npm run build

# Ensure public/build directory has correct permissions
RUN chown -R www-data:www-data /var/www/html/public/build 2>/dev/null || true

# Create logs directory and set proper permissions
RUN mkdir -p /var/www/html/storage/logs
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache DocumentRoot for Laravel
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Create a startup script that will run Laravel optimizations at runtime
RUN echo '#!/bin/bash\n\
# Download Azure MySQL SSL certificate if not exists\n\
mkdir -p /var/www/html/storage/certificates\n\
if [ ! -f "/var/www/html/storage/certificates/DigiCertGlobalRootG2.crt.pem" ]; then\n\
    curl -o /var/www/html/storage/certificates/DigiCertGlobalRootG2.crt.pem https://www.digicert.com/CACerts/DigiCertGlobalRootG2.crt.pem\n\
fi\n\
\n\
# Generate APP_KEY if not set\n\
if [ -z "$APP_KEY" ]; then\n\
    php artisan key:generate --force\n\
fi\n\
\n\
# Ensure proper permissions for storage\n\
mkdir -p /var/www/html/storage/logs\n\
chown -R www-data:www-data /var/www/html/storage\n\
chmod -R 775 /var/www/html/storage\n\
\n\
# Run Laravel optimizations\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
\n\
# Run database migrations\n\
php artisan migrate --force\n\
\n\
# Start Apache\n\
apache2-foreground\n\
' > /usr/local/bin/start.sh && chmod +x /usr/local/bin/start.sh

# Expose port 80
EXPOSE 80

# Use the startup script
CMD ["/usr/local/bin/start.sh"]
