<?php

namespace App\Services;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegistrationService
{
    public function register(array $data): User
    {
        // THE SUBJECT
        $user = User::create($data);

        // SIDE EFFECTS

        // Log the registration (directly coupled here)
        Log::info("New user registered: {$user->email}");

        // Send a welcome email (directly coupled here)
        Mail::to($user->email)->send(new WelcomeMail($user->name));

        return $user;
    }
}
