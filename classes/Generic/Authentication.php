<?php

namespace Generic;

class Authentication
{
    private $users;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn)
    {
        session_start();
        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
        $_SESSION['login_time_stamp'] = time();
    }

    public function login($username, $password)
    {
        $user = $this->users->find($this->usernameColumn, strtolower($username));
        if (!empty($user) && password_verify($password, $user[0]->{$this->passwordColumn}))
        {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0]->{$this->passwordColumn};
            return true;
        } else {
            return false;
        }
    }

    public function validateSession()
    {
        if (isset($_SESSION['username']) && (time() - $_SESSION['login_time_stamp']) > 600 || !isset($_SESSION['username']))
        {
            session_unset();
            session_destroy();
            header('location: /');
        }
    }
}