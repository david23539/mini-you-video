<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    protected $table = 'videos';
    public $timestamps = false;
    //Relacion OneToMany
    public function comments(){
        return $this->hasMany('App\comentario')->orderBy('id', 'desc');
    }

    //Relacion de muchos a uno
    public function user(){
        return $this->belongsTo('App\User', 'user_id');//el segundo paramentro idica que campo de la tabla videos se relaciona con la tabla user
    }
}
