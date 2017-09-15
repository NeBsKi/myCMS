<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    
    protected $fillable = ['title'];
    
    public function pages_data(){
        return $this->belongsTo('App\Pages_Data', 'page_id', 'id');
    }
    
    public function page_gallery(){
        return $this->hasMany('App\Page_gallery');
    }
}
