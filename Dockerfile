# =========================
# Stage 1 — Build
# =========================
FROM php:8.3-fpm-alpine AS build

# Needed arguments for the image build
ARG VITE_REVERB_APP_KEY
ARG VITE_REVERB_HOST
ARG VITE_REVERB_PORT=443
ARG VITE_REVERB_SCHEME=https

# Assigning environment variables for the arguments given.
ENV VITE_REVERB_APP_KEY=$VITE_REVERB_APP_KEY VITE_REVERB_HOST=$VITE_REVERB_HOST VITE_REVERB_PORT=$VITE_REVERB_PORT VITE_REVERB_SCHEME=$VITE_REVERB_SCHEME

# System deps + PHP extensions
RUN apk add --no-cache git unzip libzip-dev libxml2-dev sqlite-dev freetype-dev libjpeg-turbo-dev libpng-dev nodejs npm \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd pdo pdo_sqlite xml zip

# We insert the Composer binary inside the build image
COPY --from=docker.io/library/composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app
COPY . .

# Install PHP + Node deps
RUN composer install --no-dev --prefer-dist --optimize-autoloader \
    && npm install && npm run build

# Permissions OpenShift
RUN chown -R 0:0 /var/www/html && chmod -R g+rwx /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# =========================
# Stage 2 — Runtime
# =========================
FROM php:8.3-fpm-alpine

LABEL org.opencontainers.image.authors="Penta"

# Runtime deps
RUN apk add --no-cache nginx libzip libxml2 sqlite libzip-dev libxml2-dev sqlite-dev freetype-dev libjpeg-turbo-dev libpng-dev pkgconf freetype libjpeg-turbo libpng \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install pdo pdo_sqlite xml zip pcntl gd \
    && docker-php-ext-enable pcntl

# Create nginx writable dir (OpenShift)
RUN mkdir -p /nginx /nginx/php/tmp \
    && chown -R 0:0 /nginx && chmod -R g+rwx /nginx

# Copy app from build
COPY --from=build /var/www/html /var/www/html

# nginx + php custom config
COPY deploy/nginx.conf /etc/nginx/nginx.conf
COPY deploy/php.ini /usr/local/etc/php/conf.d/app.ini

WORKDIR /var/www/html

# Exposing port used by the app
EXPOSE 8080/tcp
EXPOSE 6001/tcp

# Making a persistent volume for the storage directory
VOLUME ["/var/www/html/storage/"]

# Copy entrypoint
COPY deploy/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# The entry point will be used as an init process to execute that needs to be executed in the container but before the runtime
ENTRYPOINT ["/entrypoint.sh"]

# The main process of the container is going to be nginx, and php-fpm as a background process
CMD ["sh", "-c", "php-fpm & nginx -g 'error_log /nginx/error.log warn; daemon off;'"]