<?php

namespace App\Services;

use SplSubject;
use SplObserver;
use Illuminate\Support\Facades\Log;

class LogUserCreation implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        $user = $subject->getUser();

        // Log the registration (directly coupled here)
        Log::info("New user registered: {$user->email}");
    }
}