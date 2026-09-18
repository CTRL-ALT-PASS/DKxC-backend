<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomisationGroup extends Model
{
    protected $table = 'customisation_group';
	protected $primaryKey = 'group_id';
	public $timestamps = false;

    protected $fillable = [
        'group_name',
		'selection_type',
		'is_required',
    ];

    public function options()
    {
        return $this->hasMany(
            CustomisationOption::class,
            'group_id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_customisation',
            'group_id',
            'product_id'
        );
    }
}