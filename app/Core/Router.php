<?php
// Active le mode strict pour les types
declare(strict_types=1);
// Espace de noms du noyau
namespace Mini\Core;
// Déclare le routeur HTTP minimaliste
final class Router
{
    // Tableau des routes : [méthode, chemin, [ClasseContrôleur, action]]
    /** @var array<int, array{0:string,1:string,2:array{0:class-string,1:string}} > */
    private array $routes;

    /**
     * Initialise le routeur avec les routes configurées
     * @param array<int, array{0:string,1:string,2:array{0:class-string,1:string}} > $routes
     */
    public function __construct(array $routes)
    {
        // Mémorise les routes fournies
        $this->routes = $routes;
    }

    // Dirige la requête vers le bon contrôleur en fonction méthode/URI
    public function dispatch(string $method, string $uri): void
    {
        // Extrait uniquement le chemin de l'URI
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
        if ($basePath !== '' && str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));
            if ($path === '') {
                $path = '/';
            }
        }

        // Parcourt chaque route enregistrée
        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {
            // Vérifie correspondance de la méthode
            if ($method !== $routeMethod) {
                continue;
            }

            // Routes statiques
            if (strpos($routePath, '{') === false) {
                if ($path !== $routePath) {
                    continue;
                }

                [$class, $action] = $handler;
                $controller = new $class();
                $controller->$action();
                return;
            }

            // Routes dynamiques: ex /categorie/{id}
            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $routePath);
            $pattern = '#^' . $pattern . '$#';

            if (!preg_match($pattern, $path, $matches)) {
                continue;
            }

            array_shift($matches);
            [$class, $action] = $handler;
            $controller = new $class();
            $controller->$action(...$matches);
            return;
        }

        // Si aucune route ne correspond, renvoie un 404 minimaliste
        http_response_code(404);
        echo '404 Not Found';
    }
}


