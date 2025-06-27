# Base com Apache + PHP 8.2
FROM php:8.2-apache

# Instala extensões do MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativa o mod_rewrite do Apache (caso use URLs amigáveis)
RUN a2enmod rewrite

# Copia todos os arquivos do projeto para a pasta do Apache
COPY . /var/www/html/

# Define permissões corretas
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta padrão do Apache
EXPOSE 80
