<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    //
    protected $table = 'configuration';
    protected $fillable = ['meta_title', 'meta_description', 'meta_keyword','site_title'];
}
