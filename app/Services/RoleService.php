<?php

namespace App\Services;

use App\Models\User;

class RoleService
{
    const ROLE_ADMIN = 'admin';
    const ROLE_ASSISTANT = 'assistant';
    const ROLE_STUDENT = 'student';

    public function getRoles()
    {
        return [
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_ASSISTANT => 'Assistant',
            self::ROLE_STUDENT => 'Étudiant'
        ];
    }

    public function isAdmin(User $user): bool
    {
        return $user->role === self::ROLE_ADMIN;
    }

    public function isAssistant(User $user): bool
    {
        return $user->role === self::ROLE_ASSISTANT;
    }

    public function isStudent(User $user): bool
    {
        return $user->role === self::ROLE_STUDENT;
    }
}
