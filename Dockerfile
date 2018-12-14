FROM php:5.4-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        vim \
        iproute2 \
        git \
        libmcrypt-dev \
        libicu-dev \
        libzip-dev \
        zip \
        unzip \
    && docker-php-ext-install \
       bcmath \
       intl \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip \
    && pecl install xdebug-2.4.1 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=SAMEDAY" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG UID
ARG GID
RUN mkdir /var/www \
    && usermod -u ${UID} www-data \
    && groupmod -g ${GID} www-data \
    && chown -R www-data:www-data /var/www
USER www-data

ADD ./ /var/www/php-sdk
WORKDIR /var/www/php-sdk
