<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    //he be cooking up shit in a kettle
    protected $table = 'inventory_item';
    protected $primaryKey = 'inventory_item_id';
    public $timestamps = false;
    protected $fillable = [
        'branch_id',
        'product_id',
        'quantity_on_hand',
        'last_restocked',
        'inventory_status',
    ];
    protected $casts = [
        'last_restocked' => 'datetime',
        'quantity_on_hand' => 'integer',
        'branch_id' => 'integer',
        'product_id' => 'integer',
    ];
}
