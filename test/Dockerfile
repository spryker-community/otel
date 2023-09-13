# syntax = docker/dockerfile:1.0.2-experimental
ARG SPRYKER_PHP_VERSION=8.1.22

FROM php:${SPRYKER_PHP_VERSION}-fpm-alpine3.18

ARG TARGETPLATFORM
ARG COMPOSER_VERSION=2.5.8
ARG BLACKFIRE_VERSION=1.87.1
ARG BLACKFIRE_PHP_VERSION=81
ARG NEWRELIC_VERSION=10.11.0.3
ARG TIDEWAYS_VERSION=5.5.14
ARG TIDEWAYS_PHP_VERSION=8.1

ENV srcRoot /data

RUN mkdir -p ${srcRoot}

ARG PHP_RUN_DEPS=""


ARG PHP_BUILD_DEPS="\
    libffi-dev"

ARG PHP_EXTENSIONS="\
    ffi"

ARG PHP_PECL_EXTENSIONS=""

ARG ADDITIONAL_PHP_PECL_EXTENSIONS=""

ARG CFLAGS="-I/usr/src/php"
RUN apk update \
    && apk upgrade \
    && apk add --no-cache \
    bash \
    coreutils \
    curl \
    g++ \
    git \
    make \
    mysql-client \
    netcat-openbsd \
    openssh \
    postgresql-client \
    procps \
    python3 \
    shadow \
    unzip \
    linux-headers \
    ${PHP_RUN_DEPS} \
    && \
    apk add --no-cache --virtual .php-build-deps ${PHP_BUILD_DEPS} \
    && rm -rf /var/lib/apt/lists/ \
    && \
    && docker-php-ext-install -j5 ${PHP_EXTENSIONS} \
    && docker-php-ext-enable ${PHP_EXTENSIONS} ${PHP_PECL_EXTENSIONS} \
    && apk del --no-cache .php-build-deps

# Related to https://github.com/docker-library/php/issues/240
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so

WORKDIR /data
