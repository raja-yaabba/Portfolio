FROM php:7.4-apache

# Définir le répertoire de travail
WORKDIR /var/www/web

# Copier tous les fichiers du projet
COPY . /var/www

# Vérifier que les fichiers sont bien copiés
RUN ls -la /var/www

# Vérifier que le répertoire web contient bien `frontController.php`
RUN ls -la /var/www/web

# Vérifier si `composer.json` existe avant d'exécuter Composer
RUN test -f /var/www/composer.json || (echo "composer.json introuvable !" && exit 1)

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www

# Activer mod_rewrite pour gérer les routes via `frontController.php`
RUN a2enmod rewrite

# Modifier Apache pour que `/web` soit la racine du serveur
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/web|" /etc/apache2/sites-available/000-default.conf

# Modifier apache2.conf pour activer AllowOverride All pour /var/www/web
RUN sed -i 's|<Directory /var/www/>|<Directory /var/www/web/>|g' /etc/apache2/apache2.conf && \
    sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

# Corriger les permissions des fichiers pour Apache
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Vérifier que `frontController.php` est bien accessible
RUN test -f /var/www/web/frontController.php || (echo "frontController.php introuvable !" && exit 1)

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache au démarrage
CMD ["apache2-foreground"]
