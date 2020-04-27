<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    


    protected $fillable = [];



    public function user() {
        return $this->hasMany(User::class);
    }
}
