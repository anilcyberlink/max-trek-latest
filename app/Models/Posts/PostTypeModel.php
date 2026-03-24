<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostTypeModel extends Model
{
    protected $table = 'cl_post_type';
    protected $fillable = ['post_type','uri','template','ordering','is_menu','brief','content','banner','thumbnail','post_tag','meta_keyword','meta_description'];
}
