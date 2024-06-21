<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepositories
{
    public function __construct(
        protected readonly User $user,
    ) {
    }

    public function logout($request): bool
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return true;
    }
}
