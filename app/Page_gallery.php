<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page_gallery extends Model
{
    protected $table = 'page_gallery';
    
    protected $fillable = ['path'];
    
    public function page(){
        $this->belongsTo('App\page');
    }
}
