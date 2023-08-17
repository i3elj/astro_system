<?php

require_once "model/dashboard/dashboard.model.php";

class DashboardController extends DashboardModel
{
    public const path = '/\/dashboard/';

    public function Handler(): void
    {
        match ($_SERVER['REQUEST_METHOD']) {
            'GET' => self::build_view(),
        };
    }

    private function build_view(): void
    {
        $auth_token = $_COOKIE['authToken'];
        require_once 'views/dashboard/dashboard.view.php';
        exit(0);
    }
}
