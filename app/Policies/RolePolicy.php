<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function admin(User $user)
    {
        return $user->role === 'admin';
    }

    public function student(User $user)
    {
        return $user->role === 'student';
    }
}
