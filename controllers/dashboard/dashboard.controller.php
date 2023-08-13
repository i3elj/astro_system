<?php

require_once "model/dashboard/dashboard.model.php";

class DashboardController extends DashboardModel
{
    public const path = '/\/dashboard/';

    public function Handler()
    {
        match ($_SERVER['REQUEST_METHOD']) {
            'GET' => self::build_view(),
        };
    }

    private function build_view()
    {
        require_once 'views/dashboard/dashboard.view.php';
        exit(0);
    }
}
