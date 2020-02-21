<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admincateques extends Model
{
    //
    protected $fillable = [
    	'category_id', 'question_id', 'option_id', 'ques_priority', 'next_ques_id'
    ];
}
