# Use uma imagem base do PHP com Apache
FROM php:8.1-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar o diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto
COPY . .

# Instalar as dependências do Laravel
RUN composer install

# Expor a porta 80
EXPOSE 80
