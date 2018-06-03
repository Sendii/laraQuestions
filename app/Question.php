<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function from() {
    	return $this->belongsTo('App\User', 'user_id_from', 'id');
    }

    public function to() {
    	return $this->belongsTo('App\User', 'user_id_to', 'id');
    }
}
