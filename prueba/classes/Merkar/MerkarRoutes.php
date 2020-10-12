<?php

namespace Merkar;

class MerkarRoutes implements \Generic\Routes
{
    private $usersTable;
    private $itemsTable;
    private $categoriesTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->itemsTable = new \Generic\DatabaseTable($pdo,
            'item', 'id', '\Merkar\Entity\Item', [&$this->usersTable, &$this->itemCategoriesTable, &$this->imagesTable]);

        $this->usersTable = new \Generic\DatabaseTable($pdo,
            'user', 'id', '\Merkar\Entity\User', [&$this->itemsTable]);

        $this->categoriesTable = new \Generic\DatabaseTable($pdo, 'category', 'id', '\Merkar\Entity\Category', [&$this->itemsTable, &$this->itemCategoriesTable]);

        $this->imagesTable = new \Generic\DatabaseTable($pdo, 'image', 'itemId', '\Merkar\Entity\Image', [&$this->itemsTable]);

        $this->itemCategoriesTable = new \Generic\DatabaseTable($pdo,
        'item_category', 'categoryId');

        $this->authentication =
        new \Generic\Authentication($this->usersTable,
            'email', 'password');

    }

    public function getRoutes(): array
    {
        $itemController = new \Merkar\Controllers\Item($this->itemsTable, $this->usersTable, $this->categoriesTable, $this->authentication);
        $userController = new \Merkar\Controllers\Register($this->usersTable);
        $loginController = new \Merkar\Controllers\Login($this->authentication);
        $categoryController =  new \Merkar\Controllers\Category($this->categoriesTable);

        $routes = [
            '' => [
                'GET' => [
                    'controller' => $itemController,
                    'action' => 'home',
                ],
            ],
            'category/delete' => [
                'POST' => [
                'controller' => $categoryController,
                'action' => 'delete'
                ],
                'login' => true,
                'permissions' => \Merkar\Entity\User::REMOVE_CATEGORIES
            ],
            'category/list' => [
                'GET' => [
                    'controller' => $categoryController,
                    'action' => 'list'
                ],
                'login' => true,
                'permissions' => \Merkar\Entity\User::LIST_CATEGORIES
            ],
            'category/edit' => [
                'POST' => [
                    'controller' => $categoryController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $categoryController,
                    'action' => 'edit'
                ],
                'login' => true,
                'permissions' => \Merkar\Entity\User::EDIT_CATEGORIES
            ],
            'user/permissions' => [
                'GET' => [
                'controller' => $userController,
                'action' => 'permissions'
                ],
                'POST' => [
                'controller' => $userController,
                'action' => 'savePermissions'
                ],
                'login' => true,
                'permissions' => \Merkar\Entity\User::EDIT_USER_ACCESS
            ],
            'user/list' => [
                'GET' => [
                'controller' => $userController,
                'action' => 'list'
                ],
                'login' => true
            ],
            'user/register' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'registrationForm',
                ],
                'POST' => [
                    'controller' => $userController,
                    'action' => 'registerUser',
                ],
            ],
            'user/success' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'success',
                ],
            ],
            'item/edit' => [
                'POST' => [
                    'controller' => $itemController,
                    'action' => 'saveEdit',
                ],
                'GET' => [
                    'controller' => $itemController,
                    'action' => 'edit',
                ],
                'login' => true,
            ],
            'item/delete' => [
                'POST' => [
                    'controller' => $itemController,
                    'action' => 'delete',
                ],
                'login' => true,
            ],
            'item/list' => [
                'GET' => [
                    'controller' => $itemController,
                    'action' => 'list',
                ],
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error',
                ]
            ],
            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm',
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin',
                ]
            ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success',
                ],
                'login' => true,
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
                    ]
                ],
        ];

        return $routes;
    }

    public function getAuthentication(): \Generic\Authentication
    {
        return $this->authentication;
    }

    public function checkPermission($permission): bool 
    {
        $user = $this->authentication->getUser();
        if ($user && $user->hasPermission($permission)) {
        return true;
        } else {
        return false;
        }
    }
}
