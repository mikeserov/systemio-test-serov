FROM php:8.3-fpm-alpine3.19

WORKDIR /var/www/html

RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

COPY ../.. /var/www/html

## Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --version=2.7.2 \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc

USER www-data



