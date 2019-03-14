<?php

namespace Podvysotsky\Laravel\Trust\Observers;

use Podvysotsky\Laravel\Trust\Facades\Trust;
use Illuminate\Foundation\Auth\User;

class UserObserver
{
    public function created(User $user)
    {
        Trust::reload($user);
    }

    public function updated(User $user)
    {
        Trust::reload($user);
    }

    public function deleted(User $user)
    {
        Trust::reload($user);
    }
}
