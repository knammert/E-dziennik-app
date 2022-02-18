<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_name_subject_id',
        'weekday',
        'start_time',
        'end_time'
    ];

    public function class_name_subject(){

        return $this->belongsTo(Class_name_subject::class);
    }

    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

    public function scopeCalendarByRoleOrClassId($query)
    {

        return $query->when(!request()->input('class_name_id'), function ($query) {
            $query->when(Auth::user()->is_teacher, function ($query) {
              //  dd('teacher');
                $query->join('class_name_subjects', 'schedules.class_name_subject_id', '=', 'class_name_subjects.id');
                $query->where('user_id', auth()->user()->id);
            })
                ->when(Auth::user()->is_student, function ($query) {
                    $query->join('class_name_subjects', 'schedules.class_name_subject_id', '=', 'class_name_subjects.id');
                    $query->where('class_name_id', auth()->user()->class_name_id ?? '0');
                })
                ->when(Auth::user()->is_admin, function ($query) {
                    $query->join('class_name_subjects', 'schedules.class_name_subject_id', '=', 'class_name_subjects.id');
                    $query->where('class_name_id', request()->input('typeClassId'));
                 });
        });
    }

}
