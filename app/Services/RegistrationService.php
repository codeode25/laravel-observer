<?php

namespace App\Services;

use SplSubject;
use SplObserver;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegistrationService implements SplSubject
{
    private array $observers = [];
    private ?User $user = null;

    public function attach(SplObserver $observer): void 
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer): void 
    {
        $this->observers = array_filter($this->observers, fn ($o) => $o != $observer);
    }

    public function notify(): void 
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

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
