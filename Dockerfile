FROM php:7.4-apache

# Définir le répertoire de travail principal
WORKDIR /var/www

# Copier tous les fichiers du projet
COPY . /var/www

# Vérifier que les fichiers sont bien copiés
RUN ls -la /var/www

# Vérifier que le répertoire web contient frontController.php et .htaccess
RUN ls -la /var/www/web

# Vérifier si composer.json existe avant d'exécuter Composer
RUN test -f /var/www/composer.json || (echo "composer.json introuvable !" && exit 1)

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP avec Composer (dans /var/www, PAS dans /var/www/web)
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www

# Activer mod_rewrite pour gérer les routes via `frontController.php`
RUN a2enmod rewrite

# Modifier le fichier Apache pour que `/web/` soit bien la racine du serveur
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/web|" /etc/apache2/sites-available/000-default.conf

# Changer les permissions des fichiers pour Apache
RUN chown -R www-data:www-data /var/www/web && chmod -R 755 /var/www/web

# Vérifier que frontController.php est bien accessible
RUN test -f /var/www/web/frontController.php || (echo "frontController.php introuvable !" && exit 1)

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache au démarrage
CMD ["apache2-foreground"]