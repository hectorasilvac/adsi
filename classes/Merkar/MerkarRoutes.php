<?php

namespace Merkar;

class MerkarRoutes implements \Generic\Routes
{
    private $userTable;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->userTable = new \Generic\DatabaseTable($pdo, 'user', 'user_id', '\Merkar\Entity\User');
        $this->authentication = new \Generic\Authentication($this->userTable, 'user_email', 'user_password');
    }

    public function getRoutes(): array
    {
        $userController = new \Merkar\Controllers\User($this->userTable);
        $loginController = new \Merkar\Controllers\Login($this->authentication);

        $routes = [
            '' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin'
                ]
            ],
            'user/list' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'list'
                ],            
            ],
            'user/delete' => [
                'POST' => [
                    'controller' => $userController,
                    'action' => 'delete'
                ],
            ],
            'user/edit' => [
                'POST' => [
                    'controller' => $userController,
                    'action' => 'edit'
                ],
                'GET' => [
                    'controller' => $userController,
                    'action' => 'edit'
                ],
            ],
        ];

        return $routes;
    }
}    
