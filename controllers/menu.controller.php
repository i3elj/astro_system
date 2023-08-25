<?php

require_once 'model/menu.model.php';

class Menu extends MenuModel
{
    public function __construct(private string $path = '/\/menu/')
    {
    }

    public function Handler(): void
    {
        match ($_SERVER['REQUEST_METHOD']) {
            'GET' => self::build_view(),
            default => badrequest(),
        };
    }

    private function build_view(): void
    {
        require_once 'views/menu.view.php';
        exit(0);
    }
}
