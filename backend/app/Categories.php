<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{  
    protected $fillable = [
        'cat_name','description','file','user_id','type_id'
    ];
}
