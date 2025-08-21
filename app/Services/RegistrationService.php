<?php

namespace App\Services;

use SplSubject;
use SplObserver;
use App\Models\User;
use App\Mail\WelcomeMail;
use App\Traits\SplSubjectTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegistrationService implements SplSubject
{
    use SplSubjectTrait;

    private ?User $user = null;

    public function register(array $data): User
    {
        // THE SUBJECT
        $this->user = User::create($data);

        // SIDE EFFECTS
        $this->notify();

        return $this->user;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
