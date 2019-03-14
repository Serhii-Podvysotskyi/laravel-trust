<?php

namespace Podvysotsky\Laravel\Trust\Observers;

use Podvysotsky\Laravel\Trust\Facades\Trust;

class UserObserver
{
    public function created($user)
    {
        Trust::reload($user);
    }

    public function updated($user)
    {
        Trust::reload($user);
    }

    public function deleted($user)
    {
        Trust::reload($user);
    }
}
