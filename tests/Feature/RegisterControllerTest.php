<?php

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);


it('registers a user and triggers observers', function () {
    // Fake dependencies
    Log::spy();
    Mail::fake();

    $response = $this->postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'secret123',
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'message' => 'User registered successfully',
             ]);

    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com',
    ]);

    Log::shouldHaveReceived('info')
        ->withArgs(fn ($message) => str_contains($message, 'john@example.com'))
        ->once();

    Mail::assertSent(WelcomeMail::class, 1);

});
