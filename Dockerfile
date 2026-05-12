FROM php:8.2-cli

WORKDIR /app
COPY . .

# Required for PDO PostgreSQL connections (pgsql: DSN)
RUN docker-php-ext-install pdo pdo_pgsql

EXPOSE 10000

CMD ["sh", "-c", "php -S 0.0.0.0:$PORT -t api api/index.php"]



