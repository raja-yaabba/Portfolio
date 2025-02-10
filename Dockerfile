FROM php:7.4-apache

# Définir le répertoire de travail principal
WORKDIR /var/www/html

# Copier tous les fichiers du projet
COPY . /var/www/html

# Vérifier que les fichiers sont bien copiés
RUN ls -la /var/www/html

# Vérifier que le répertoire web contient frontController.php et .htaccess
RUN ls -la /var/www/html/web

# Vérifier si composer.json existe avant d'exécuter Composer
RUN test -f /var/www/html/composer.json || (echo "composer.json introuvable !" && exit 1)

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP avec Composer (dans /var/www/html, PAS dans /var/www/html/web)
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# Activer mod_rewrite pour gérer les routes via `frontController.php`
RUN a2enmod rewrite

# Modifier le fichier Apache pour que `/web/` soit bien la racine du serveur
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/html/web|" /etc/apache2/sites-available/000-default.conf

# Changer les permissions des fichiers pour Apache
RUN chown -R www-data:www-data /var/www/html/web && chmod -R 755 /var/www/html/web

# Vérifier que frontController.php est bien accessible
RUN test -f /var/www/html/web/frontController.php || (echo "frontController.php introuvable !" && exit 1)

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache au démarrage
CMD ["apache2-foreground"]

# Redémarrer Apache
RUN service apache2 restart
