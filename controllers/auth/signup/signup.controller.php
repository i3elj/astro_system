<?php

require_once 'model/auth/signup/signup.model.php';

class SignUpController extends SignUpModel
{
    public const path = '/\/signup/';

    public function Handler()
    {
        match ($_SERVER['REQUEST_METHOD']) {
            'GET' => self::build_view(),
        };
    }

    private function build_view()
    {
        $title = 'Astro System - SignUp';
        require_once 'views/auth/signup/signup.view.php';
        exit(0);
    }
}
