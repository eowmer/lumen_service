FROM alpine:latest

ARG APP_ENV
ENV APP_ENV $APP_ENV

# Install Packages

RUN apk add --no-cache autoconf php7-dev git php7-pear tzdata libmemcached-dev rabbitmq-c-dev zlib-dev
RUN apk add --no-cache git file re2c autoconf make g++
RUN apk add --no-cache curl vim nginx zlib zlib-dev ca-certificates openssl libmemcached rabbitmq-c supervisor

RUN apk add --no-cache imagemagick && \
    apk add --no-cache imagemagick-dev

# Install PHP Packages
RUN apk add --no-cache php7 php7-dom php7-fpm php7-cgi php7-mbstring php7-mcrypt php7-opcache php7-pdo php7-pdo_pgsql php7-pdo_sqlite 
RUN apk add --no-cache php7-fileinfo php7-xml php7-simplexml php7-xmlreader php7-xmlwriter php7-phar php7-openssl php7-json php7-curl
RUN apk add --no-cache php7-ctype php7-session php7-zlib php7-tokenizer php7-xdebug php7-xsl php7-gd php7-iconv php7-zip php7-imagick

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Configure nginx
COPY .docker/lumen/config/nginx.conf /etc/nginx/nginx.conf

# Configure php-fpm
COPY .docker/lumen/config/fpm-pool.conf /etc/php7/php-fpm.d/custom.conf
COPY .docker/lumen/config/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY .docker/lumen/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN apk --update upgrade --no-cache
# Install PHP Driver
RUN pecl channel-update pecl.php.net
RUN pecl install -f mongodb; \
    echo 'extension=mongodb.so' > /etc/php7/conf.d/mongodb.ini;
RUN pecl install -f igbinary; \
    echo 'extension=igbinary.so' > /etc/php7/conf.d/igbinary.ini;

# Correct TIMEZONE to Asia/Manila
RUN apk add -U tzdata \
    && cp /usr/share/zoneinfo/Asia/Manila /etc/localtime \
    && apk del tzdata \
    && rm -rf \
    /var/cache/apk/*

# Add application
RUN mkdir -p /var/www/html

# add source
ADD lumen /var/www/html/lumen
WORKDIR /var/www/html/lumen

# set environment file
WORKDIR /var/www/html/lumen
ADD .env /var/www/html/lumen

# set permission
WORKDIR /var/www/html/lumen
RUN touch /var/www/html/lumen/storage/logs/lumen.log
RUN chmod -R 777 /var/www/html/lumen/storage/
RUN chmod -R 777 /var/www/html/lumen/storage/logs/
# incase not working
# docker-compose exec lumen chmod -R 777 /var/www/html/lumen/storage

# composer install
WORKDIR /var/www/html/lumen
# composer update
RUN php /usr/bin/composer clearcache
RUN php /usr/bin/composer install
RUN php /usr/bin/composer dump-autoload

RUN php /var/www/html/lumen/artisan migrate
RUN php /var/www/html/lumen/artisan db:seed

EXPOSE 22 80 443
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]