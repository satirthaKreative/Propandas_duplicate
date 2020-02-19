<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminquestion extends Model
{
    //
    protected $fillable = [
    	'question_name', 'question_type', 'question_description', 'question_subheading', 'status',
    ];
}
