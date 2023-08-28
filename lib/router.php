<?php

/**
 * Create a router based on regex.
 *
 * @param array $routes Holds an associative array that have a key value pair,
 * where `'path'` represents the endpoint and `'controller'` represents which
 * controller will take care of that endpoint.
 *
 *      - `[ 'path' => '/\/home/', 'controller' => 'HomeController' ]`
 *
 * @param string $path The current path the client are on.
 * @return void
 */
function create_router($routes, $path)
{
    foreach ($routes as $route) {
        if (preg_match($route['path'], $path, $matches)) {
            $view = new $route['controller']($path);
            $view->Handler();
        }
    }

    notfound();
}
