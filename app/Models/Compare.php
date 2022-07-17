<?php

namespace App\Models;

class Compare
{
    public $items = null;

    public function __construct($oldCompare)
    {
        if ($oldCompare) {
            $this->items = $oldCompare->items;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['item' => $item];
        if ($this->items)
        {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $this->items[$id] = $storedItem;
    }

    public function removeItem($id)
    {
        unset($this->items[$id]);
    }
}
