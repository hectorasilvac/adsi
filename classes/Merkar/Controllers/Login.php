<?php

namespace Merkar\Controllers;

class Login
{
    private $authentication;

    public function __construct(\Generic\Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function loginForm()
    {
        $title = 'Acceso de Usuarios | Merkar';
        return [
            'template' => 'home.html.php',
            'title' => $title,
            'variables' => [
            ]
        ];
    }

    public function processLogin()
    {

        if ($this->authentication->login($_POST['user_email'], $_POST['user_password']))
        {
            header('location: /user/list');
        } else {
            echo 'Fallido';
        }
    }
}