<?php

namespace App\Policies;

use App\Models\Class_name_subject;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GradePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyTeacher(User $user, $type)
    {
        $activity = Class_name_subject::find($type);

        if($user->role == 2 && ($activity == null || $user->id == $activity->user_id)){
            return true;
        }
        else{
            return false;
        }
    }

     /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyStudent(User $user)
    {
        return $user->role == 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Grade $grade)
    {

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 2;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Grade $grade)
    {
       return $grade->class_name_subject->user_id == $user->id;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Grade $grade)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Grade $grade)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Grade $grade)
    {
        //
    }
}
