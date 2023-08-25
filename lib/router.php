<?php

function create_router(array $routes, string $current_path)
{
    foreach ($routes as $route) {
        if (preg_match($route['path'], $current_path, $matches)) {
            if ($current_path != $matches[0])
                notfound();

            $view = new $route['controller']($current_path);
            $view->Handler();
        }
    }
}
