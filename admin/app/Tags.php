<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    //
    protected $table = 'tags';
      protected $fillable = [
        'name', 'slug', 'meta_title','meta_description','is_populer'
    ];
}
