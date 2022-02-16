<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Class_name_subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_name_id',
        'subject_id',
        'user_id',
        'weekday',
        'start_time',
        'end_time'
    ];


    const WEEK_DAYS = [
        '1' => 'Poniedziałek',
        '2' => 'Wtorek',
        '3' => 'Środa',
        '4' => 'Czawartek',
        '5' => 'Piatek',
    ];

    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

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



    public function scopeCalendarByRoleOrClassId($query)
    {

        return $query->when(!request()->input('class_name_id'), function ($query) {
            $query->when(Auth::user()->is_teacher, function ($query) {
              //  dd('teacher');
                $query->where('user_id', auth()->user()->id);
            })
                ->when(Auth::user()->is_student, function ($query) {
                   // dd('student');
                    $query->where('class_name_id', auth()->user()->class_name_id ?? '0');
                })
                ->when(Auth::user()->is_admin, function ($query) {

                    $query->where('class_name_id', request()->input('typeClassId'));
                 });
        });
    }

}
