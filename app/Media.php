<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Media extends Model
{
    protected $table = 'media';
    protected $guarded = array('media_id_str');
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\UserId', 'user_id_str', 'user_id_str');
    }
}
