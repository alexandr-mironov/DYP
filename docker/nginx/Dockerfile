FROM nginx

#COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/templates/nginx.conf.template /etc/nginx/templates/nginx.conf.template

RUN chmod -R 0777 /var/run