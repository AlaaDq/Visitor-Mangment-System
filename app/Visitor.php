<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
   use SoftDeletes;

   protected $guarded=[];

   protected $primaryKey = 'national_id';
  
   public function visits(){
    return $this->hasMany('App\Visit','visitor_id','national_id');
   }
   public function trashedVisits(){
    return $this->hasMany('App\Visit','visitor_id','national_id')->onlyTrashed();
   }

   public function getFullNameAttribute()
   {
       return "{$this->first_name} {$this->last_name}";
   }

}
