<?php

namespace Merkar\Controllers;

use \Generic\DatabaseTable;

class Register
{
    private $usersTable;

    public function __construct(DatabaseTable $usersTable)
    {
        $this->usersTable = $usersTable;
    }

    public function registrationForm()
    {
        return ['template' => 'register.html.php', 'title' => 'Registrar una cuenta'];
    }

    public function success()
    {
        return ['template' => 'registersuccess.html.php', 'title' => 'Registro exitoso!'];
    }

    public function registerUser()
    {
        $customer = $_POST['customer'];
        // Assume the data is valid to begin with
        $valid = true;
        $errors = [];
        // But if any of the fields have been left blank
        // set $valid to false
        if (empty($customer['firstname'])) {
            $valid = false;
            $errors[] = 'Name cannot be blank';
        }
        if (empty($customer['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
        } else if (filter_var($customer['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = 'Invalid email address';
        } else { 
            // If the email is not blank and valid:
            // convert the email to lowercase
            $customer['email'] = strtolower($customer['email']);
            // Search for the lowercase version of $customer['email']
            if (count($this->usersTable->
            find('email', $customer['email'])) > 0) {
                $valid = false;
                $errors[] = 'That email address is already registered';
            }
        }
        if (empty($customer['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
        }
        // If $valid is still true, no fields were blank
        //  and the data can be added
        if ($valid == true) {
            $customer['password'] = password_hash($customer['password'],
     PASSWORD_DEFAULT);
            $this->usersTable->save($customer);
            header('Location: /customer/success');
        } else {
            // If the data is not valid, show the form again
            return ['template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'customer' => $customer
                ],
            ];
        }

    }
    public function list()
    {
        $users = $this->usersTable->findAll();
        return ['template' => 'userlist.html.php',
        'title' => 'user List',
        'variables' => [
            'users' => $users
        ]
        ];   
    }
    
    public function permissions() {
        $user = $this->usersTable->findById($_GET['id']);
        $reflected = new \ReflectionClass('\Merkar\Entity\User');
        $constants = $reflected->getConstants();
        return ['template' => 'permissions.html.php',
        'title' => 'Edit Permissions',
        'variables' => [
            'user' => $user,
            'permissions' => $constants
        ]
        ];  
    }

    public function savePermissions() {
        $user = [
        'id' => $_GET['id'],
        'permissions' => array_sum($_POST['permissions'] ?? [])
        ];
        $this->usersTable->save($user);
        header('location: /user/list');
    }
}
