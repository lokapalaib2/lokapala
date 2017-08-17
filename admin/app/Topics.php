<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    //
      protected $table = 'topics';
      protected $fillable = [
        'name', 'slug'
    ];
}
