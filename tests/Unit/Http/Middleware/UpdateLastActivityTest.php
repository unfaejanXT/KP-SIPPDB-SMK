<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\UpdateLastActivity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class UpdateLastActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_last_activity_is_updated_when_null()
    {
        $user = User::factory()->create([
            'last_login_at' => null,
            'last_login_ip' => null
        ]);

        $this->actingAs($user);

        $request = Request::create('/dashboard', 'GET');
        $middleware = new UpdateLastActivity();

        $middleware->handle($request, function () {
            return response('OK');
        });

        $user->refresh();
        $this->assertNotNull($user->last_login_at);
        $this->assertNotNull($user->last_login_ip);
        $this->assertEquals($request->ip(), $user->last_login_ip);
    }

    public function test_user_last_activity_is_updated_when_older_than_one_minute()
    {
        $oldTime = now()->subMinutes(5);
        $user = User::factory()->create([
            'last_login_at' => $oldTime,
            'last_login_ip' => '192.168.1.1'
        ]);

        $this->actingAs($user);

        $request = Request::create('/dashboard', 'GET', [], [], [], ['REMOTE_ADDR' => '127.0.0.1']);
        $middleware = new UpdateLastActivity();

        $middleware->handle($request, function () {
            return response('OK');
        });

        $user->refresh();
        $this->assertNotNull($user->last_login_at);
        $this->assertTrue($user->last_login_at->greaterThan($oldTime));
        $this->assertEquals('127.0.0.1', $user->last_login_ip);
    }

    public function test_user_last_activity_not_updated_when_recent()
    {
        $recentTime = now()->subSeconds(30);
        $user = User::factory()->create([
            'last_login_at' => $recentTime,
            'last_login_ip' => '192.168.1.100'
        ]);

        $this->actingAs($user);

        $request = Request::create('/dashboard', 'GET');
        $middleware = new UpdateLastActivity();

        $middleware->handle($request, function () {
            return response('OK');
        });

        $user->refresh();
        // Should NOT update because it's less than 1 minute old
        $this->assertEquals($recentTime->timestamp, $user->last_login_at->timestamp);
        $this->assertEquals('192.168.1.100', $user->last_login_ip);
    }

    public function test_guest_does_not_trigger_update()
    {
        $request = Request::create('/login', 'GET');
        $middleware = new UpdateLastActivity();

        $response = $middleware->handle($request, function () {
            return response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
        // No errors should occur for guest users
    }
}
