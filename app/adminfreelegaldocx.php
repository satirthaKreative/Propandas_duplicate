<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminfreelegaldocx extends Model
{
    //
    protected $fillable =  [
    	'cate_id', 'is_upload', 'uploaded_path', 'uploaded_text', 'uploaded_type'
    ];
}
