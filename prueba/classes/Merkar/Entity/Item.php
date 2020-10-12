<?php

namespace Merkar\Entity;

class Item
{
    public $id;
    public $brand;
    public $name;
    public $description;
    public $content;
    public $measurement;
    public $price;
    public $date;
    public $userId;
    private $usersTable;
    private $user;
    private $itemCategoriesTable;
    private $imagesTable;

    public function __construct(\Generic\DatabaseTable $usersTable, \Generic\DatabaseTable $itemCategoriesTable, \Generic\DatabaseTable $imagesTable)
    {
        $this->usersTable = $usersTable;
        $this->itemCategoriesTable = $itemCategoriesTable;
        $this->imagesTable = $imagesTable;
    }

    public function getUser()
    {
        if(empty($this->user))
        {
            $this->user = $this->usersTable->findById($this->userId);
        }
        return $this->user;
    }

    public function getImage()
    {
        $images = $this->imagesTable->findAll();
        foreach ($images as $image)
        {
            if ($image->id == $this->id)
            {
                return $image;
            }
        }
    }

    public function addCategory($categoryId)
    {
        $itemCategory = ['itemId' => $this->id,
        'categoryId' => $categoryId];

        $this->itemCategoriesTable->save($itemCategory);
    }
    public function hasCategory($categoryId)
    {
        $itemCategories = $this->itemCategoriesTable->
        find('itemId', $this->id);
        foreach ($itemCategories as $itemCategory) {
            if ($itemCategory->categoryId == $categoryId) {
                return true;
            }
        }
    }
    public function clearCategories() {
        $this->itemCategoriesTable->deleteWhere('itemId',
         $this->id);
    }
}