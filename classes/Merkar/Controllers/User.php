<?php

namespace Merkar\Controllers;

use \Generic\DatabaseTable, \Generic\Authentication;

class User
{
    private $usersTable;
    
    public function __construct(DatabaseTable $userTable, Authentication $authentication)
    {
     $this->userTable = $userTable;   
     $this->authentication = $authentication;
    }

    public function edit()
    {
        $user = $_POST['user'];
        try {
            $this->userTable->save($user);
        } catch (\Exception $e) {
            $process = $e->getMessage();
        }

        return [
            'template' => 'edit.html.php',
            'variables' => [
                'user' => $user,
                'process' => $process ?? null
            ]
        ];
    }
    public function list()
    {
        $this->authentication->validateSession();
        
        $users = $this->userTable->findAll();
        $title = 'Lista de Usuarios';
        return ['template' => 'list.html.php',
                'title' => $title,
                'variables' => [
                    'users' => $users
                ]
            ];
    }
    public function delete() {
        $user_id = $_POST['user']['user_id'];
        try {
            $this->userTable->delete($user_id);
        } catch (\Exception $e) {
            $process = $e->getMessage();
        }
        $title = 'Estado de Transacción';
        return ['template' => 'edit.html.php',
                'title' => $title,
                'variables' => [
                    'process' => $process ?? null
                ]
            ];
    }
}