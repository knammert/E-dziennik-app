<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function users(){

        return $this->hasMany(User::class);
    }

    public function Class_name_subject(){

        return $this->hasMany(Class_name_subject::class);
    }
}
