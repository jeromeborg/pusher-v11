<?php

namespace App\Policies;

use App\Models\Code;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CodePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->check();
    }


    public function create(User $user): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

//    public function update(User $user, Code $code): bool
//    {
//        return auth()->check() && auth()->user()->role === 'admin';
//    }
//
//    public function delete(User $user, Code $code): bool
//    {
//        return auth()->check() && auth()->user()->role === 'admin';
//    }


}
