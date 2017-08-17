<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $table = 'content';
    protected $fillable = [
        'title', 'id_category', 'summary', 'slug', 'id_penulis', 'id_topics'
        , 'id_image_cover', 'video_url', 'status', 'tipe', 'body'
    ];
}
