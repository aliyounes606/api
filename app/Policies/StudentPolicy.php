<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{

    public function modify(User $user, $id): Response
    {
        return $user->id === $id->user_id
            ? Response::allow()
            : Response::deny('you are not the own of this student info');
    }
}
