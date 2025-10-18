<?php

namespace App\Routing;
// ------------------------------
// ESPACE DE NOMS
// ------------------------------
// On place cette classe dans le namespace "App\Routing".
// Cela permet d’organiser le code et d’éviter les conflits de noms
// avec d’autres classes (par exemple un Router d’une autre librairie).
// PHP saura exactement où chercher cette classe : App/Routing/Router.php

class Router
{
    // ------------------------------
    // PROPRIÉTÉS PRIVÉES
    // ------------------------------
    private string $controllerMethod; // Nom de la méthode à appeler (ex: "index", "show")
    private string $controllerName;   // Nom complet du contrôleur (ex: "App\Controller\Homepage")

    private ?int $parameter = null;

    // ------------------------------
    // CONSTRUCTEUR
    // ------------------------------
    // Appelé automatiquement lors de la création de l’objet :
    // Exemple : $router = new Router('GET', '/articles/show');
    //
    // - $requestMethod : méthode HTTP de la requête (GET, POST, etc.)
    // - $uri : l’URL demandée par le client (ex: "/", "/articles/show/2")
    public function __construct(private readonly string $requestMethod, string $uri)
    {
        // ------------------------------
        // 1️⃣ Redirection de la racine "/"
        // ------------------------------
        if ($uri === "/") {
            // Si l’utilisateur visite directement la racine du site,
            // on le redirige vers "/homepage/index" par défaut.
            $uri = '/homepage/index';
        }

        // ------------------------------
        // 2️⃣ Découpage de l’URL
        // ------------------------------
        // On découpe l’URL avec "/" comme séparateur.
        // Exemple : "/homepage/index" → ["", "homepage", "index"]
        $uriExploded = explode('/', $uri);

        // Le premier élément est vide (avant le premier "/"), on le retire.
        array_shift($uriExploded); // Résultat : ["homepage", "index"]
        // ------------------------------
        // 3️⃣ Vérification de validité
        // ------------------------------
        if (count($uriExploded) < 2) {
            // Si on n’a pas au moins un contrôleur et une méthode,
            // l’URL est invalide → on lève une exception.
            throw new \Exception("Page not found");
        }
        // ------------------------------
        // 5️⃣ Construction du nom du contrôleur
        // ------------------------------
        // On commence par le namespace de base :
        $controllerName = 'App\Controller\\'; // attention au double backslash (échappement PHP)

        $counter = 1;
        $uriLength = count($uriExploded);

        if(is_numeric($uriExploded[$uriLength -1])){
            $this->parameter = array_pop($uriExploded);
        }

        // ------------------------------
        // 4️⃣ Extraction de la méthode du contrôleur
        // ------------------------------
        // Le dernier élément du tableau est le nom de la méthode (ex: "index", "show")
        $this->controllerMethod = array_pop($uriExploded);
        $uriLength = count($uriExploded);
        // à ce stade :
        // Étape	Code exécuté	                       /!\ Résultat $uriExploded /!\	            Valeur extraite
        //  1	    explode('/', '/polls/show/1')	        ["", "polls", "show", "1"]	        —
        //  2	    array_shift()	                        ["polls", "show", "1"]	            —
        //  3	    array_pop() (si numérique)	            ["polls", "show"]	                $parameter = 1
        //  4	    array_pop() (méthode)	                ["polls"]	                        $controllerMethod = "show"


        // Parcours du tableau restant pour reconstituer le nom complet du contrôleur
        foreach($uriExploded as $uriPart) {
            if (!$uriPart) {
                continue; // Ignore les chaînes vides, sécurité supplémentaire
            }

            // On ajoute un "\" entre les parties (ex : "Admin\Users")
            $separator = ($counter === $uriLength) ? '' : '\\';

            // ucfirst() met la première lettre en majuscule
            // Exemple : "homepage" → "Homepage"
            $controllerName .= ucfirst($uriPart) . $separator;
            $counter++;
        }

        // Si aucun nom valide n’a été construit → erreur
        if ('App\Controller\\' === $controllerName) {
            throw new \Exception("Page not found");
        }

        // On enregistre le nom final dans la propriété
        // Exemple : "App\Controller\Homepage"
        $this->controllerName = $controllerName;
    }

    // ------------------------------
    // MÉTHODE render()
    // ------------------------------
    // Cette méthode exécute le bon contrôleur + la bonne méthode selon l’URL.
    // Exemple : "/articles/show" → App\Controller\ArticlesController->show()
    public function render(): array
    {
        // 1️⃣ Reconstitution du nom complet de la classe contrôleur
        $controllerName = $this->controllerName . 'Controller';
        // Exemple : "App\Controller\HomepageController"

        // 2️⃣ Instanciation dynamique du contrôleur
        // PHP permet d’instancier une classe dont le nom est contenu dans une variable.
        // Ici, cela crée un objet du bon contrôleur selon l’URL.
        $controller = new $controllerName();

        // 3️⃣ Exécution selon le type de requête HTTP
        // Pour une requête GET : on appelle la méthode correspondant à l’action
        // Exemple : /article/show → $controller->show()
        if ('GET' === $this->requestMethod ) {
            if ($this->parameter) {
                $data = $controller->{$this->controllerMethod}($this->parameter);
            } else {

                $data = $controller->{$this->controllerMethod}();
            }
            return $data;

        } if ('POST' === $this->requestMethod) {
            if($this->parameter) {

            } else {
                $postedData = $_POST;
                $postedData['date'] = new \DateTime('now');
                $redirectUri = $controller->{$this->controllerMethod}($postedData);
            }

            // Pour une requête POST : ici -> gérer les formulaires (à venir)
            // Exemple : /user/login → $controller->login($_POST);
            header('location:' . $redirectUri);

            return null;
        }
        throw new \Exception("HTTP method not allowed");

        // 4️⃣ Retourne les données obtenues
        // En général, le contrôleur renvoie un tableau que la vue affichera ensuite.

    }

}
