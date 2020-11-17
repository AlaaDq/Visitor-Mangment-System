<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;

    protected $guarded=[];

    public function visitor(){
        return  $this->belongsTo('App\Visitor','visitor_id', 'national_id');
    }

    public function trashedVisitor(){
        if(!auth()->user()->hasRole('admin'))
        return  $this->belongsTo('App\Visitor','visitor_id', 'national_id');
        else
        return  $this->belongsTo('App\Visitor','visitor_id', 'national_id')->onlyTrashed();
    }
    
    public function employee(){
      return  $this->belongsTo('App\Employee');
    }

    public function department(){
      return  $this->belongsTo('App\Department');
    }


}
