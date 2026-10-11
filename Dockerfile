FROM php:8.1-apache

# نصب پکیج‌های ضروری
RUN docker-php-ext-install pdo pdo_mysql

# کپی کردن کدهای پروژه به مسیر وب‌سرور آپاچی
COPY . /var/www/html/

# تنظیم دسترسی‌ها
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
