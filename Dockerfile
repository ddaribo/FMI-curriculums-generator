FROM php:8.2-apache

# Database connection — override these via your deployment platform's UI
ENV DB_HOST=localhost \
    DB_USER=root \
    DB_PASS="" \
    DB_NAME=curriculumsprojectdb

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (required for .htaccess routing)
RUN a2enmod rewrite

# Inline Apache virtual host config — AllowOverride All so .htaccess rules work
RUN printf '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>\n' > /etc/apache2/sites-available/000-default.conf

# Copy application source into the expected subdirectory path
# so that URLROOT = http://<host>/FMIcurriculums resolves correctly
COPY . /var/www/html/FMIcurriculums/

# Fix ownership for the web server
RUN chown -R www-data:www-data /var/www/html/FMIcurriculums

EXPOSE 80
