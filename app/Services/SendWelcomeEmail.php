<?php

namespace App\Services;

use SplSubject;
use SplObserver;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        $user = $subject->getUser();

        // Send a welcome email (directly coupled here)
        Mail::to($user->email)->send(new WelcomeMail($user->name));
    }
}