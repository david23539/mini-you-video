<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comentario extends Model
{
    public $timestamps = false;
    //
    protected $table ='comments';

    public function user(){
    	return $this->belongsTo('App\user', 'user_id');
    }

    public function video(){
    	return $this->belongsTo('App\video', 'video_id');
    }

}
