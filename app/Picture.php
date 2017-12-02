<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    public function incident()
    {
        return $this->belongsTo('App\Incident');
    }
}
