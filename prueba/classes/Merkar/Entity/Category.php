<?php
namespace Merkar\Entity;
use Generic\DatabaseTable;

class Category
{
    public $id;
    public $name;
    private $itemsTable;
    private $itemCategoriesTable;
    public function __construct(DatabaseTable $itemsTable,
     DatabaseTable $itemCategoriesTable)
    {
        $this->itemsTable = $itemsTable;
        $this->itemCategoriesTable = $itemCategoriesTable;
    }
    public function getItems($limit = null, $offset = null)
    {
        $itemCategories = $this->itemCategoriesTable->
        find('categoryId', $this->id, null, $limit, $offset);
        $items = [];
        foreach ($itemCategories as $itemCategory) {
            $item =  $this->itemsTable->
            findById($itemCategory->itemId);
            if ($item) {
                $items[] = $item;
            }

            usort($items, [$this, 'sortItems']);
        }
        return $items;
    }

    // private function sortItems($a, $b) {
    //     $aDate = new \DateTime($a->date);
    //     $bDate = new \DateTime($b->date);
    //     if ($aDate->getTimestamp() == $bDate->getTimestamp()) {
    //     return 0;
    //     }
    //     return $aDate->getTimestamp() > $bDate->getTimestamp() ? -1 : 1;
    // }

    public function getNumItems() {
        return $this->itemCategoriesTable->total('categoryId',
        $this->id);
    }
}