FROM php:8.2-fpm-alpine

#Arguments defined in the docker-composer.yml
ARG user
ARG uid
ARG gid

#Install system dependencies
RUN apk update && apk add

# Install PHP extension
RUN docker-php-ext-install pdo pdo_mysql bcmath

#Get latest composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

RUN addgroup -g $gid --system $user
RUN adduser -G $user --system -D -s /bin/sh -u $uid $user

RUN sed -i "s/user = www-data/user = $user/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = $user/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

#Set workign directory
WORKDIR /var/www/html

USER $user

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]