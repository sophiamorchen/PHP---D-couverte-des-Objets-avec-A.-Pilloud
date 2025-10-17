<?php

// Ici on utilise la classe Router qui se trouve dans le namespace App\Routing
// Cela permet d’écrire juste "Router" plus bas au lieu de "App\Routing\Router"
use App\Routing\Router;

// On inclut l'autoloader de Composer
// Composer est le gestionnaire de dépendances PHP
// 'vendor/autoload.php' charge automatiquement toutes les classes de notre projet et des packages installés
require_once 'vendor/autoload.php';

// On crée une instance de notre routeur
// $_SERVER['REQUEST_METHOD'] contient la méthode HTTP de la requête (GET, POST, PUT, DELETE, etc.)
// $_SERVER['REQUEST_URI'] contient l'URL que l'utilisateur a demandée, par exemple "/homepage/action"
// Le routeur va analyser ces informations pour savoir quelle action exécuter
$router = new Router($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

// Exemple de correspondance URL -> méthode du contrôleur :
// Si l'utilisateur tape "/homepage/action", le routeur va chercher la classe "HomepageController"
// et exécuter la méthode "action" de cette classe
// Si l'URL est "/mon-super/action", le routeur va chercher "MonSuperController" et appeler "action"
// Si l'URL est "/users/admin/action", le routeur va chercher "App\Controller\Users\AdminController"
// et appeler la méthode "action" de ce contrôleur
// Ce système permet de faire de l'auto-routing, c'est-à-dire que chaque URL correspond automatiquement
// à un contrôleur et à une méthode, sans avoir à écrire toutes les routes à la main

$data = $router->render();

// Ici, on crée une variable $page pour récupérer directement la clé 'page' du tableau $data
// Cela évite d'avoir à écrire $data['page'] à chaque utilisation dans la vue
$page = $data['page'];

//var_dump($data);
// Affiche les données retournées par la méthode du contrôleur
// Cela sert uniquement à des fins de test et de débogage
// Exemple : le contrôleur pourrait renvoyer un tableau avec des infos à afficher dans la vue
require_once 'views/base.php';