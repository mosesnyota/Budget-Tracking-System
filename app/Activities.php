<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $primaryKey = 'activity_id';

    protected $guarded = array();
    protected $attributes = [
        'completion_date' => null,
    ];
}
