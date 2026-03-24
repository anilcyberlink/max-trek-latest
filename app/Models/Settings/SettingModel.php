<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'cl_settings';
    protected $fillable = ['site_name','logo',' worked_with','affililiated_with','phone','email_primary','email_secondary','address','facebook_link','linkedin_link','youtube_link','twitter_link','instagram_link','meta_key',
                'meta_description','google_map','google_map2','copyright_text','fax','skype','caption'];
}
