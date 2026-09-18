<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
	protected $table = 'product_size';
	protected $primaryKey = 'size_id';
	public $timestamps = false;
	
    protected $fillable = [
        'product_id',
        'size_label',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}