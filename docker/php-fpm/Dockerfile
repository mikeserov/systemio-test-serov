FROM php:8.3-fpm-alpine3.19

WORKDIR /var/www/html

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions \
    pdo_pgsql \
    xdebug
RUN rm /usr/bin/install-php-extensions

RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
COPY ./docker/php-fpm/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini

COPY ../.. /var/www/html

## Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --version=2.7.2 \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc

RUN apk add postgresql-client

USER www-data



