<?php

namespace App\Models\Team;

use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
   protected $table = 'cl_team';
    protected $fillable = [
        'name','position','category','facebook_url','instagram_url','twitter_url','youtube_url','wikipedia_url','phone','email','content','brief','status','ordering','banner','thumbnail','uri','team_key','show_in_home'
    ];


}
