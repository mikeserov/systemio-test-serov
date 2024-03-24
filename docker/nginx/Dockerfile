FROM nginx:1.25-alpine3.18

COPY ./public/ /var/www/html/public/
COPY ./docker/nginx/templates/nginx-server.conf.template /etc/nginx/templates/default.conf.template
