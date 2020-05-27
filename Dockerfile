FROM dockerhub.singulato.com/singulato/nginx-php:latest

COPY ./ /data/www/
COPY ./etc/nginx/app.conf /etc/nginx/conf.d/app.conf

RUN cd /data/www && composer install

#RUN crontab -u nginx /data/www/etc/crontab.conf

RUN chmod -R 777 /data/www/storage

#RUN cd /data/www && php artisan migrate -n

