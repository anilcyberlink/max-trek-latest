<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class PageTypeModel extends Model
{
    protected $table = 'cl_pagetype';
    protected $fillable = ['page_type','uri','template','ordering','is_menu','status','image','brief','external_link'];

    public function question_ans(){
    	return $this->hasMany('App\Models\Pages\PageDetails','page_id');
    }

    public function page_data(){
    	return $this->hasMany('App\Models\Pages\PageModel','page_type');
    }

    public function page_details()
    {
        return $this->hasManyThrough('App\Models\Pages\PageDetails', 'App\Models\Pages\PageModel', 'page_type', 'page_id');
    }
}
