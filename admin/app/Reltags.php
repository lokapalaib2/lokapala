<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reltags extends Model
{
    //
     protected $table = 'rel_tags';
     public $timestamps = false;
      protected $fillable = [
        'id_content', 'id_tags'
    ];
}
