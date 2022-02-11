<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function class_name_subject()
    {
        return $this->belongsTo(Class_name_subject::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
