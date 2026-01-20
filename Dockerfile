# =========================
# Stage 1 — Build
# =========================
FROM php:8.3-fpm-alpine AS build

ARG VITE_REVERB_APP_KEY
ARG VITE_REVERB_HOST
ARG VITE_REVERB_PORT
ARG VITE_REVERB_SCHEME

ENV VITE_REVERB_APP_KEY=$VITE_REVERB_APP_KEY
ENV VITE_REVERB_HOST=$VITE_REVERB_HOST
ENV VITE_REVERB_PORT=$VITE_REVERB_PORT
ENV VITE_REVERB_SCHEME=$VITE_REVERB_SCHEME

# System deps + PHP extensions
RUN apk add --no-cache \
    git \
    unzip \
    libzip-dev \
    libxml2-dev \
    sqlite-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    nodejs \
    npm \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        xml \
        zip \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd

# Composer
COPY --from=docker.io/library/composer:2.7.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app
COPY . .

# Install PHP + Node deps
RUN composer install --no-dev --prefer-dist --optimize-autoloader \
    && npm install \
    && npm run build

# Permissions OpenShift
RUN chown -R 0:0 /var/www/html \
    && chmod -R g+rwx /var/www/html/storage /var/www/html/bootstrap/cache

# =========================
# Stage 2 — Runtime
# =========================
FROM php:8.3-fpm-alpine

# Runtime deps
RUN apk add --no-cache \
    nginx \
    libzip \
    libxml2 \
    sqlite \
    libzip-dev \
    libxml2-dev \
    sqlite-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    pkgconf \
    freetype \
    libjpeg-turbo \
    libpng \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        xml \
        zip \
        pcntl \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd \
    &&  docker-php-ext-enable pcntl

# Create nginx writable dir (OpenShift)
RUN mkdir -p /nginx /nginx/php/tmp \
    && chown -R 0:0 /nginx \
    && chmod -R g+rwx /nginx \
    && chown -R 0:0 /var/www/html \
    && chmod -R g+rwx /var/www/html

# Copy app from build
COPY --from=build /var/www/html /var/www/html

# nginx + php config
COPY deploy/nginx.conf /etc/nginx/nginx.conf
COPY deploy/php.ini /usr/local/etc/php/conf.d/app.ini

WORKDIR /var/www/html

EXPOSE 8080
EXPOSE 6001

# Copy entrypoint
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

CMD ["sh", "-c", "php-fpm & nginx -g 'error_log /nginx/error.log warn; daemon off;'"]