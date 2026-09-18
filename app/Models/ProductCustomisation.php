<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCustomisation extends Model
{
	protected $table = 'customisation_option';
	
    protected $fillable = [
        'product_id',
        'group_id',
    ];
}