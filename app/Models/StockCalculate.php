<?php

namespace App\Models;

class StockCalculate
{
    public $product_id;
    public $old_stock = 0;
    public $new_stock = 0;
    public $total_stock = 0;
    public $damaged_stock = 0;
    public $returned_stock = 0;
    public $withholding_stock = 0;
    public $delivered_stock = 0;
    public $sellable_stock = 0;
    public $remaining_stock = 0;
    public $returned_damage_stock = 0;

    public function __construct($curStock)
    {
        if($curStock){
            $this->product_id = $curStock->product_id;
            $this->old_stock = $curStock->old_stock;
            $this->new_stock = $curStock->new_stock;
            $this->total_stock = $curStock->total_stock;
            $this->damaged_stock = $curStock->damaged_stock;
            $this->returned_stock = $curStock->returned_stock;
            $this->withholding_stock = $curStock->withholding_stock;
            $this->delivered_stock = $curStock->delivered_stock;
            $this->sellable_stock = $curStock->sellable_stock;
            $this->remaining_stock = $curStock->remaining_stock;
            $this->returned_damage_stock = $curStock->returned_damage_stock;
        }
    }

    public function newStock($newStock)
    {
        $this->old_stock = $this->total_stock;
        $this->new_stock = $newStock;
        $this->total_stock = $this->old_stock + $this->new_stock;
        $this->sellable_stock += $newStock;
        $this->remaining_stock += $newStock;
    }

    public function damageStock($damageStock)
    {
        $this->damaged_stock += $damageStock;
        $this->sellable_stock -= $damageStock;
        $this->remaining_stock -= $damageStock;
    }

    public function withholdingStock($withholdingStock)
    {
        $this->withholding_stock += $withholdingStock;
        // $this->sellable_stock -= $withholdingStock;
        $this->remaining_stock = $this->sellable_stock - $this->withholding_stock;
    }

    public function deliverStock($deliverStock)
    {
        $this->delivered_stock += $deliverStock;
        $this->sellable_stock -= $deliverStock;
        $this->withholding_stock -= $deliverStock;
    }

    public function returnStock($returnStock)
    {
        $this->returned_stock += $returnStock;
        $this->sellable_stock += $returnStock;
        $this->remaining_stock += $returnStock;
        $this->delivered_stock -= $returnStock;
    }

    public function returnDamageStock($returnDamageStock)
    {
        $this->returned_damage_stock += $returnDamageStock;
        $this->delivered_stock -= $returnDamageStock;
    }

    public function returnOrderStock($returnOrderStock)
    {

        $this->withholding_stock -= $returnOrderStock;
        $this->remaining_stock +=   $returnOrderStock;
    }
}
