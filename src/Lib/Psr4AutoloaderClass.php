<?php

namespace App\Portfolio\Lib;

/**
 * Autoloader PSR-4
 */
class Psr4AutoloaderClass
{
    /**
     * Un tableau associatif où la clé est un préfixe de namespace
     * et la valeur est un tableau de répertoires de base pour les classes dans ce namespace.
     *
     * @var array
     */
    protected array $prefixes = array();

    /**
     * Enregistre l'autoloader dans la pile SPL.
     *
     * @return void
     */
    public function register() : void
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Ajoute un répertoire de base pour un préfixe de namespace.
     *
     * @param string $prefix Le préfixe du namespace.
     * @param string $base_dir Un répertoire de base pour les fichiers de classe dans ce namespace.
     * @param bool $prepend Si vrai, ajoute le répertoire de base au début de la pile au lieu de la fin.
     * @return void
     */
    public function addNamespace(string $prefix, string $base_dir, bool $prepend = false) : void
    {
        // Normalise le préfixe du namespace
        $prefix = trim($prefix, '\\') . '\\';

        // Normalise le répertoire de base avec un séparateur à la fin
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        // Initialise le tableau du préfixe du namespace
        if (!isset($this->prefixes[$prefix])) {
            $this->prefixes[$prefix] = array();
        }

        // Ajoute le répertoire de base à la pile
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
            array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    /**
     * Charge le fichier de la classe donnée.
     *
     * @param string $class Le nom complet de la classe.
     * @return mixed Le nom du fichier chargé en cas de succès, ou false en cas d'échec.
     */
    public function loadClass(string $class)
    {
        // Le préfixe du namespace actuel
        $prefix = $class;

        // Parcourt les namespaces pour trouver un fichier correspondant
        while (false !== $pos = strrpos($prefix, '\\')) {
            // Retient le préfixe du namespace
            $prefix = substr($class, 0, $pos + 1);

            // Le reste est le nom de la classe relative
            $relative_class = substr($class, $pos + 1);

            // Tente de charger un fichier mappé pour le préfixe et la classe relative
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // Supprime le séparateur de namespace pour la prochaine itération
            $prefix = rtrim($prefix, '\\');
        }

        // Aucun fichier mappé trouvé
        return false;
    }

    /**
     * Charge le fichier mappé pour un préfixe de namespace et une classe relative.
     *
     * @param string $prefix Le préfixe du namespace.
     * @param string $relative_class Le nom de la classe relative.
     * @return mixed False si aucun fichier mappé n'a été trouvé, ou le nom du fichier mappé.
     */
    protected function loadMappedFile(string $prefix, string $relative_class)
    {
        // Y a-t-il des répertoires de base pour ce préfixe de namespace ?
        if (!isset($this->prefixes[$prefix])) {
            return false;
        }

        // Cherche dans les répertoires de base pour ce préfixe de namespace
        foreach ($this->prefixes[$prefix] as $base_dir) {
            // Remplace le préfixe du namespace par le répertoire de base,
            // remplace les séparateurs de namespace par des séparateurs de répertoires
            // dans le nom de la classe relative, et ajoute ".php"
            $file = $base_dir
                  . str_replace('\\', '/', $relative_class)
                  . '.php';

            // Si le fichier existe, on l'inclut
            if ($this->requireFile($file)) {
                // Fichier trouvé, on a terminé
                return $file;
            }
        }

        // Aucun fichier trouvé
        return false;
    }

    /**
     * Si le fichier existe, on l'inclut depuis le système de fichiers.
     *
     * @param string $file Le fichier à inclure.
     * @return bool Vrai si le fichier existe, faux sinon.
     */
    protected function requireFile(string $file) : bool
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
}
?>
