<?php

namespace App\Traits;

use SplObserver;

trait SplSubjectTrait
{
    private array $observers = [];

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
}