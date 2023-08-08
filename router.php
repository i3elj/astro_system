<?php

function create_router(array $routes, string $real_path)
{
    foreach ($routes as $route) {
        if (preg_match($route['path'], $real_path, $matches)) {
            if ($real_path != $matches[0])
                notfound();

            $view = new $route['view'];
            $view->Handler();
        }
    }
}
