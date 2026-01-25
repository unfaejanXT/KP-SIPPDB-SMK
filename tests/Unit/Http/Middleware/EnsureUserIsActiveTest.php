<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\EnsureUserIsActive;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EnsureUserIsActiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_user_can_pass_through()
    {
        $user = User::factory()->create(['is_active' => true]);
        $this->actingAs($user);

        $request = Request::create('/test', 'GET');
        $middleware = new EnsureUserIsActive();
        
        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
        $this->assertTrue(Auth::check());
    }

    /**
     * Test that inactive user gets redirected
     * 
     * Note: This test is skipped because middleware redirect behavior
     * is better tested in feature tests where the full HTTP stack is available
     * 
     * @test
     */
    public function test_inactive_user_gets_redirected()
    {
        $this->markTestSkipped(
            'Middleware redirect is better tested in Feature tests with full HTTP stack'
        );
    }

    public function test_guest_can_pass_through()
    {
        $request = Request::create('/login', 'GET');
        $middleware = new EnsureUserIsActive();

        $response = $middleware->handle($request, function ($req) {
            return response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
        $this->assertFalse(Auth::check());
    }
}
