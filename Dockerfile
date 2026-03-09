FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    sqlite3 \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install zip pdo pdo_sqlite

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Create environment file
RUN cp .env.example .env

# Create SQLite database
RUN mkdir -p database \
 && touch database/database.sqlite

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache

# Generate key
RUN php artisan key:generate

# Run migrations
RUN php artisan migrate --force

# Cache configs
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000