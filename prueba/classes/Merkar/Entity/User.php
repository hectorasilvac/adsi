<?php

namespace Merkar\Entity;

class User
{
    const EDIT_ITEMS = 1;
    const DELETE_ITEMS = 2;
    const LIST_CATEGORIES = 4;
    const EDIT_CATEGORIES = 8;
    const REMOVE_CATEGORIES = 16;
    const EDIT_USER_ACCESS = 32;

    public $id;
    public $idcard;
    public $firstname;
    public $lastname;
    public $gender;
    public $phone;
    public $email;
    public $department;
    public $town;
    public $city;
    public $address;
    public $password;
    public $permissions;
    private $itemsTable;

    public function __construct(\Generic\DatabaseTable $itemsTable)
    {
        $this->itemsTable = $itemsTable;
    }
    public function getItems()
    {
        return $this->itemsTable->find('userId', $this->id);
    }

    public function addItem($item)
    {
        $item['userId'] = $this->id;
        return $this->itemsTable->save($item);
    }

    public function hasPermission($permission) {
        return $this->permissions & $permission;  
    }
}