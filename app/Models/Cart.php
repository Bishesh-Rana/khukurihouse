<?php

namespace App\Models;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;

            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'affId'=>''];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        if (empty($storedItem['affId'])){
            $storedItem['affId'] = $item->aff_id;
        }
        $storedItem['currency'] = $item['currency'];
        $storedItem['qty'] = $item->quantity + $storedItem['qty'];
        $storedItem['price'] = $item->product_original_price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $item->quantity;
        $this->totalPrice += $item->product_original_price * $item->quantity;
    }

    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['product_original_price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['product_original_price'];

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function increaseByOne($id)
    {
        $this->items[$id]['qty']++;
        $this->items[$id]['price'] += $this->items[$id]['item']['product_original_price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['item']['product_original_price'];
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
