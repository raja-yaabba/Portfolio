<?php
// Inclure l'autoloader
require_once '../src/Lib/Psr4AutoloaderClass.php';

// Initialiser l'autoloader
$loader = new App\Portfolio\Lib\Psr4AutoloaderClass();
$loader->register();

// Ajouter les namespaces
$loader->addNamespace('App\Portfolio\Controller', '../src/Controller');
$loader->addNamespace('App\Portfolio\Model', '../src/Model');
$loader->addNamespace('App\Portfolio\View', '../src/View');
$loader->addNamespace('App\Portfolio\Lib', '../src/Lib');

// Définir le contrôleur et l'action par défaut
use App\Portfolio\Controller\MainController;
use App\Portfolio\Controller\ContactController;

$controller = isset($_GET["controller"]) ? ucfirst($_GET["controller"]) : 'Main'; // 'Main' par défaut
$action = $_GET['action'] ?? 'home'; // 'home' par défaut

// Construire le nom de la classe du contrôleur
$controllerClassName = "App\\Portfolio\\Controller\\" . $controller . "Controller";

// Vérification de l'existence du contrôleur et de l'action avant de les appeler
if (class_exists($controllerClassName)) {
    $controllerInstance = new $controllerClassName(); // Créer une instance du contrôleur
    
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action(); // Appeler la méthode dynamiquement
    } else {
        $mainController = new MainController();
        $mainController->error(); // Afficher une page d'erreur si l'action n'existe pas
    }
} else {
    $mainController = new MainController();
    $mainController->home(); // Retourner à la page d'accueil par défaut si le contrôleur n'existe pas
}

// Inclure le fichier de mise en page
require_once '../src/View/layout.php';
