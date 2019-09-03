<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserId extends Model
{
    protected $table = 'user';
    protected $guarded = array('user_id_str');
    public $timestamps = false;
    public function media()
    {
        return $this->hasMany('App\Media', 'user_id_str', 'user_id_str');
    }
}
