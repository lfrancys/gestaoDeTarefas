FROM php:8.2-fpm-alpine

#Define the working directory
WORKDIR /var/www

# Install dependencies
RUN apk update && apk add --no-cache \
    build-base \
    linux-headers \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    curl \
    curl-dev \
    unzip \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    git \
    libzip-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg\
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml curl pdo zip

# Install Xdebug Extension
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Clear cache
RUN rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy config
COPY ./.docker/app/local.ini /usr/local/etc/php/conf.d/local.ini

# Remove default server definition
RUN rm -rf /var/www/html

# Adding current user to www-data group
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

# Change current user to www
USER www

# Copy existing application directory with permissions
COPY --chown=www:www . /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
