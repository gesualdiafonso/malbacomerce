# docker/php/Dockerfile

FROM php:8.1-apache

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Instala extensões do PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Define permissões
RUN chown -R www-data:www-data /var/www/html

# Ativa display de erros no PHP
RUN echo "display_errors=On\nerror_reporting=E_ALL" > /usr/local/etc/php/conf.d/docker-php-errors.ini

EXPOSE 80
