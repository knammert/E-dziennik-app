<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_name_subject extends Model
{
    public function class_names(){

        return $this->hasMany(Class_name::class);
    }

    public function subjects(){

        return $this->hasMany(Subject::class);
    }

}
