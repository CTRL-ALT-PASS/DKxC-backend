<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomisationOption extends Model
{
    protected $table = 'customisation_option';

    protected $fillable = [
        'group_id',
        'option_name',
        'additional_cost',
    ];

    public function group()
    {
        return $this->belongsTo(
            CustomisationGroup::class,
            'group_id'
        );
    }
}