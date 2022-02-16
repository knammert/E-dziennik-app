<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'surname',
        'pesel',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function class_name()
    {
        return $this->belongsTo(Class_name::class);
    }
    public function class_name_subject()
    {
        return $this->hasMany(Class_name_subject::class);
    }
    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }


    public function getIsAdminAttribute()
    {
        if($xd = $this->role == 3){
            return true;
        }
        return false;
    }

    public function getIsTeacherAttribute()
    {
        if($xd = $this->role == 2){
            return true;
        }
        return false;
    }

    public function getIsStudentAttribute()
    {
        if($xd = $this->role == 1){
            return true;
        }
        return false;
    }


    public function scopeUsersByRoleOrName($query)
    {
        return $query->when(request()->input('type'), function ($query) {
            if(request('type')==4){
                $query->where('role', 0);
            }
            else{
                $query->where('role', request('type'));
            }


        })->when(request()->input('phrase'), function ($query) {
            $phrase = request('phrase');
            $query->whereRaw('name like ?', ["$phrase%"]);
         });
    }
}
