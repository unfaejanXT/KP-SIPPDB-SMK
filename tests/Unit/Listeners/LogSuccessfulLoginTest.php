<?php

namespace Tests\Unit\Listeners;

use App\Listeners\LogSuccessfulLogin;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogSuccessfulLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_listener_updates_user_last_login_info()
    {
        $user = User::factory()->create([
            'last_login_at' => null,
            'last_login_ip' => null
        ]);

        // Create the event
        $event = new Login('web', $user, false);

        // Handle the event with the listener
        $listener = new LogSuccessfulLogin();
        $listener->handle($event);

        // Refresh user data from database
        $user->refresh();

        // Assert that last_login_at and last_login_ip are set
        $this->assertNotNull($user->last_login_at);
        $this->assertNotNull($user->last_login_ip);
    }

    public function test_listener_updates_existing_login_info()
    {
        $oldTime = now()->subDays(1);
        $user = User::factory()->create([
            'last_login_at' => $oldTime,
            'last_login_ip' => '192.168.1.1'
        ]);

        // Mock the request IP
        request()->server->set('REMOTE_ADDR', '127.0.0.1');

        $event = new Login('web', $user, false);
        $listener = new LogSuccessfulLogin();
        $listener->handle($event);

        $user->refresh();

        $this->assertNotNull($user->last_login_at);
        $this->assertTrue($user->last_login_at->greaterThan($oldTime));
        $this->assertEquals('127.0.0.1', $user->last_login_ip);
    }

    public function test_listener_captures_correct_ip_address()
    {
        $user = User::factory()->create();

        // Mock a specific IP address
        request()->server->set('REMOTE_ADDR', '203.0.113.1');

        $event = new Login('web', $user, false);
        $listener = new LogSuccessfulLogin();
        $listener->handle($event);

        $user->refresh();

        $this->assertEquals('203.0.113.1', $user->last_login_ip);
    }

    public function test_listener_does_not_throw_error_with_valid_user()
    {
        $user = User::factory()->create();
        $event = new Login('web', $user, false);
        $listener = new LogSuccessfulLogin();

        // Should not throw any exceptions
        try {
            $listener->handle($event);
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->fail('Listener threw an unexpected exception: ' . $e->getMessage());
        }
    }
}
