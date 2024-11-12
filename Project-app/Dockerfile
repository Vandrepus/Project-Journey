# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Устанавливаем Node.js и npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs


# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo pdo_mysql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем файлы проекта
COPY . /var/www/html

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Обновляем DocumentRoot для Apache на папку public
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Даем права на запись папке storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Активируем модуль переписывания URL для Apache
RUN a2enmod rewrite

# Открываем порт 80
EXPOSE 80
