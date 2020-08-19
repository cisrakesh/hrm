<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    protected $table = 'feedbacks'; 

    public function schedule(){
    	return $this->belongsTo('App\Model\Schedule','id','schedule_id');
    }

    public function skill(){
    	return $this->hasMany('App\Model\Skills','id','skill_id');
    }
}
