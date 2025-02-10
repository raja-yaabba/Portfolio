FROM php:8.2-apache

# Définir le bon répertoire de travail basé sur ta structure
WORKDIR /var/www

# Copier tous les fichiers du projet
COPY . /var/www

# Vérifier que les fichiers sont bien copiés
RUN ls -la /var/www

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP avec Composer
RUN composer install --working-dir=/var/www

# Activer mod_rewrite pour gérer les routes via `frontController.php`
RUN a2enmod rewrite

# Définir le répertoire web root sur `/web`
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/web|" /etc/apache2/sites-available/000-default.conf

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache au démarrage
CMD ["apache2-foreground"]
