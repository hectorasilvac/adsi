<?php
namespace Merkar\Entity;
use Generic\DatabaseTable;

class Image {
    public $id;
    public $itemId;
    public $url;
    public $alt;
    public $longdesc;
    private $itemsTable;

    public function __construct(DatabaseTable $itemsTable)
    {
        $this->itemsTable = $itemsTable;
    }
}