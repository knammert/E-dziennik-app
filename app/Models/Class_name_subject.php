<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_name_subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_name_id',
        'subject_id',
        'user_id'
    ];


    public function class_name()
    {
        return $this->belongsTo(Class_name::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }


}
