<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admincategory extends Model
{
    //
    protected $fillable =  [
    	'category_name', 'category_title', 'category_description', 'parent_id', 'status'
    ];
}
