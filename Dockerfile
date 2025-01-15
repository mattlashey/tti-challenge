FROM jasoryeh/php-laravel

COPY ./ /home/container/app

RUN chmod -R 777 /home/container/app

#RUN npm i && npm run build
