<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class Currency extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'currency_id';
    protected $guarded = array();
  
}
