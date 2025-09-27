FROM php:8.2-fpm-alpine3.20

RUN apk add --no-cache \
    bash \
    vim \
    git \
    libxml2-dev \
    oniguruma-dev \
    zlib-dev \
    curl \
    imap-dev \
    krb5-dev \
    cyrus-sasl-dev \
    openssl-dev \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ./conf.d/* /usr/local/etc/php/conf.d/
