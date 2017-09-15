<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages_Data extends Model
{
    protected $table = 'pages_data';

    public $timestamps = false;
    
    public function page(){
        return $this->hasMany('App\Page');
    }
}
