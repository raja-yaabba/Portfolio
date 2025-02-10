<?php

namespace App\Portfolio\Controller;

class MainController
{
    // Afficher une vue
    protected static function afficheVue(array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__."/../View/layout.php"; // Charge la vue
    }

    // Afficher une page d'erreur
    public static function error(string $errorMessage = "Page non trouvée. Vous allez être redirigé..."): void {
        static::afficheVue([
            "errorMessage" => $errorMessage,
            "pagetitle" => "Erreur",
            "cheminVueBody" => __DIR__ . "/../View/error.php"
        ]);
    
        // Rediriger après 3 secondes vers la page d'accueil
        echo '<meta http-equiv="refresh" content="3;url=/portfolio/web/frontController.php">';
        exit();
    }    

    // Afficher la page d'accueil
    public static function home(): void {
        static::afficheVue([
            "pagetitle" => "Accueil",
            "cheminVueBody" => __DIR__ . "/../View/home.php"
        ]);
    }
    
    // Méthode pour rediriger l'utilisateur vers une URL
    protected static function rediriger(string $url): void {
        header("Location: $url");
        exit();
    }
}
?>