FROM php:8.4-fpm-bookworm

ARG UID
ARG GID
ARG REDIS_VERSION=6.1.0

ENV UID=${UID:-1000}
ENV GID=${GID:-1000}

WORKDIR /var/www/html

# Создаем пользователя и группу
RUN groupadd -g ${GID} laravel \
    && useradd -m -u ${UID} -g laravel -s /bin/bash laravel

# Настраиваем PHP-FPM под этого пользователя
RUN sed -i "s/^user = .*/user = laravel/" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/^group = .*/group = laravel/" /usr/local/etc/php-fpm.d/www.conf

# Официальный клиент MySQL 8.0 (mysqldump для php artisan db:backup) — той же
# серии, что и сервер. В репозиториях Debian его нет: пакет mysql-client там
# ставит клиент MariaDB, который с MySQL 8 совместим не гарантированно.
RUN apt-get update && apt-get install -y ca-certificates curl gnupg \
    && curl -fsSL https://repo.mysql.com/RPM-GPG-KEY-mysql-2025 | gpg --dearmor -o /usr/share/keyrings/mysql.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/mysql.gpg] http://repo.mysql.com/apt/debian bookworm mysql-8.0" > /etc/apt/sources.list.d/mysql.list \
    && apt-get update && apt-get install -y mysql-community-client \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка зависимостей и расширений PHP
RUN apt-get update && apt-get install -y \
    git \
    bash \
    zip \
    unzip \
    libzip-dev \
    libxml2-dev \
    pkg-config \
    libssl-dev \
    zlib1g-dev \
    g++ \
    make \
    autoconf \
    && docker-php-ext-install pdo pdo_mysql zip opcache \
    && pecl install https://pecl.php.net/get/redis-${REDIS_VERSION}.tgz \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 9000
CMD ["php-fpm"]
