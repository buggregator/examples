ARG PHP_IMAGE=8.3-cli-alpine3.21

FROM --platform=${TARGETPLATFORM:-linux/amd64} php:${PHP_IMAGE}

ENV TZ="UTC"
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/install-php-extensions

RUN apk update && apk add --no-cache \
  bash \
  ca-certificates \
  libzip \
  linux-headers \
  sqlite sqlite-dev \
  ${PHPIZE_DEPS}

RUN install-php-extensions intl \
  && install-php-extensions zip \
  && install-php-extensions curl \
  && install-php-extensions opcache \
  && install-php-extensions pcntl \
  && install-php-extensions sockets \
  && install-php-extensions xhprof \
  && install-php-extensions pdo_sqlite \
  && install-php-extensions pdo_pgsql pgsql

RUN apk del --no-cache ${PHPIZE_DEPS} \
    && rm -rf /tmp/*

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

RUN composer update --no-dev --optimize-autoloader --no-interaction

RUN chmod -R 0777 storage bootstrap

EXPOSE 8000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0
