<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
	protected $guarded = ["id"];
	
	public function posts() {
    return $this->belongsToMany('App\Post');
    }
    
    public function category()
    {
     return $this->belongsTo('App\Category');
    }

}

