<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
     protected $table = 'page_models';
    protected $fillable = [
        'page_date','page_author','template','template','page_title','sub_title','page_content','page_excerpt','uri','page_key','page_type','page_parent','page_order','page_banner','page_thumbnail','page_video','meta_keyword','meta_description','associated_title','external_link','page_tags','status','published','is_active','is_draft','is_trashed','show_in_home','is_password_protected','is_commentable','lang','external_link'
    ];

    public function details(){
    	return $this->hasMany('App\Models\Pages\PageDetails','page_id');
    }
}
