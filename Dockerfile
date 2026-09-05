# 1. Базовый образ: берем готовую среду с PHP 8.2 и сервером Apache на базе Debian
FROM php:8.2-apache

# 2. Установка расширений PHP для работы с базой MySQL
RUN docker-php-ext-install pdo pdo_mysql

# 3. Включаем модуль rewrite для Apache (нужен для красивых ссылок и роутинга)
RUN a2enmod rewrite

# 4. Задаем рабочую директорию, откуда Apache по умолчанию отдает сайты
WORKDIR /var/www/html

# 5. Копируем все исходники нашего проекта внутрь образа в рабочую папку
COPY . /var/www/html/

# 6. Выставляем права: отдаем файлы служебному пользователю веб-сервера (www-data)
RUN chown -R www-data:www-data /var/www/html

# 7. Информируем Docker, что веб-сервер слушает стандартный HTTP-порт 80
EXPOSE 80
