FROM nginx:stable-alpine

#Arguments defined in the docker-composer.yml
ARG user
ARG uid
ARG gid

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

RUN addgroup -g $gid --system $user
RUN adduser -G $user --system -D -s /bin/sh -u $uid $user
RUN sed -i "s/user  nginx/user $user/g" /etc/nginx/nginx.conf

ADD ./configs/nginx/default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/html