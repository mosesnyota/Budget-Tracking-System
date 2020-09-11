<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';
    protected $guarded = array();
    protected $attributes = [
        'cur_status' => 'Active',
        'completed_on'=> null,
     ];
}
