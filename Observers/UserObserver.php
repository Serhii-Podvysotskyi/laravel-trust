<?php

namespace App\Services\Trust1\Observers;

use App\Services\Trust1\Facades\Trust;

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
