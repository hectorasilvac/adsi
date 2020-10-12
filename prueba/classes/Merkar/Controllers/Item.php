<?php

namespace Merkar\Controllers;

use \Generic\Authentication;
use \Generic\DatabaseTable;

class Item
{
    private $itemsTable;
    private $usersTable;
    private $categoriesTable;
    private $authentication;

    public function __construct(DatabaseTable $itemsTable,
        DatabaseTable $usersTable, DatabaseTable $categoriesTable, Authentication $authentication) {
        $this->itemsTable = $itemsTable;
        $this->usersTable = $usersTable;
        $this->categoriesTable = $categoriesTable;
        $this->authentication = $authentication;
    }

    public function home()
    {
        $title = 'Hipermercado a tu medida | Merkar';

        return ['template' => 'home.html.php', 'title' => $title];
    }

    public function list()
    {
        $page = $_GET['page'] ?? 1;

        $offset = ($page-1)*10;

        if (isset($_GET['category'])) {
            $category = $this->categoriesTable->findById($_GET['category']);
            $items = $category->getItems(10, $offset);
            $totalItems = $category->getNumItems();
        } else {
            $items = $this->itemsTable->findAll('date DESC', 10, $offset);
            $totalItems = $this->itemsTable->total();
        }

        $title = 'Lista de Productos';
        $user = $this->authentication->getUser();

        return ['template' => 'items.html.php', 'title' => $title, 'variables' => ['totalItems' => $totalItems, 'items' => $items, 'user' => $user, 'categories' => $this->categoriesTable->findAll(), 'currentPage' => $page, 'category' => $_GET['category'] ?? null]];
    }

    public function saveEdit()
    {
        $user = $this->authentication->getUser();

        $item = $_POST['item'];
        $item['date'] = new \DateTime();

        $itemEntity = $user->addItem($item);

        $itemEntity->clearCategories();

        foreach ($_POST['category'] as $categoryId) {
            $itemEntity->addCategory($categoryId);
        }

        header('location: /item/list');
    }

    public function edit()
    {
        $user = $this->authentication->getUser();
        $categories = $this->categoriesTable->findAll();

        if (isset($_GET['id'])) {
            $item = $this->itemsTable->findById($_GET['id']);
        }
        $title = 'Editar Producto';

        return ['template' => 'edititem.html.php', 'title' => $title, 'variables' => ['item' => $item ?? null, 'user' => $user, 'categories' => $categories]];
    }

    public function delete()
    {
        $user = $this->authentication->getUser();

        $item = $this->itemsTable->findById($_POST['id']);

        if ($item->userId != $user->id && !$user->hasPermission(\Merkar\Entity\User::DELETE_ITEMS)) {
            return;
        }

        $this->itemsTable->delete($_POST['id']);
        header('location: /product/list');
    }
}
