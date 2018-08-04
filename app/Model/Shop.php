<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
   // protected $table = 'my_tablename';
	
	   public function user()
    {
        return $this->belongsTo('App\User');
    }
 public function products()
    {
        return $this->hasMany('App\Model\Product');
    }

}
