<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function users(){

        return $this->belongsTo(User::class);
    }

    public function Class_name_subject(){

        return $this->belongsTo(Class_name_subject::class);
    }
}
