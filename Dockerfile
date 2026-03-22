FROM php:7.3-apache

# Habilita o mod_rewrite do Apache (necessário para o .htaccess do seu ERP)
RUN a2enmod rewrite

# Instala extensões PHP necessárias para o PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Copia os arquivos do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Ajusta as permissões para o Apache
RUN chown -R www-data:www-data /var/www/html

# Define a variável de ambiente para o Composer permitir rodar como root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Expõe a porta 80
EXPOSE 80
