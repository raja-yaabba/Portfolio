# Utilisation de l'image officielle PHP avec Apache
FROM php:8.2-apache

# Définir le bon répertoire de travail
WORKDIR /var/www/web

# Copier tous les fichiers du projet dans /var/www
COPY . /var/www

# Vérifier que les fichiers sont bien copiés
RUN ls -la /var/www/web

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP avec Composer dans /var/www/web
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/web

# Activer mod_rewrite pour gérer les routes via `frontController.php`
RUN a2enmod rewrite

# Modifier le fichier Apache pour que `/web` soit bien la racine du serveur
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/web|" /etc/apache2/sites-available/000-default.conf

# Redémarrer Apache après la modification du DocumentRoot
RUN service apache2 restart

# Vérifier que frontController.php est bien accessible
RUN test -f /var/www/web/frontController.php || (echo "frontController.php introuvable !" && exit 1)

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache au démarrage
CMD ["apache2-foreground"]
