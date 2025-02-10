<?php
/**
 * Charge les variables d'environnement depuis un fichier `.env` et les stocke dans $_ENV et putenv().
 */
function loadEnv($file = __DIR__ . '/../.env') {
    // vérifie si le fichier .env existe sinon arrête la fonction
    if (!file_exists($file)) {
        return;
    }

    // lit le fichier ligne par ligne en ignorant les lignes vides
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        // ignore les lignes qui commencent par '#' (commentaires dans le .env)
        if (strpos(trim($line), '#') === 0) { 
            continue;
        }
        
        // sépare la ligne en clé et valeur (séparées par '=')
        list($key, $value) = explode('=', $line, 2);
        
        // stocke la variable d'environnement via putenv() et $_ENV[]
        putenv(trim($key) . '=' . trim($value));
        $_ENV[trim($key)] = trim($value);
    }
}

// charge les variables d'environnement au moment de l'inclusion du script
loadEnv();
