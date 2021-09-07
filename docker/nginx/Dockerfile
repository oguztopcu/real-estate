FROM nginx:1.21.1

LABEL maintainer = 'Oguz Topcu <oguztopcu7@gmail.com>'

WORKDIR /etc/nginx

RUN apt -y update

RUN apt install -y vim

COPY ./conf/default.conf /etc/nginx/conf.d/default.conf
