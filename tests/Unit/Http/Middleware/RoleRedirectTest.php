<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\RoleRedirect;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class RoleRedirectTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Clear any seeded data to ensure clean state
        \App\Models\Role::query()->delete();
        \App\Models\Permission::query()->delete();
    }

    public function test_admin_redirected_from_student_routes()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);

        $this->actingAs($admin);

        $request = Request::create('/dashboard', 'GET');
        $middleware = new RoleRedirect();

        $response = $middleware->handle($request, function () {
            return response('Should not reach');
        });

        $this->assertTrue($response->isRedirect());
        $this->assertEquals(route('admin.dashboard'), $response->headers->get('Location'));
    }

    public function test_user_redirected_from_admin_routes()
    {
        $userRole = Role::create(['name' => 'user']);
        $user = User::factory()->create();
        $user->assignRole($userRole);

        $this->actingAs($user);

        $request = Request::create('/admin/dashboard', 'GET');
        $middleware = new RoleRedirect();

        $response = $middleware->handle($request, function () {
            return response('Should not reach');
        });

        $this->assertTrue($response->isRedirect());
        $this->assertEquals(route('dashboard'), $response->headers->get('Location'));
    }

    public function test_admin_can_access_admin_routes()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);

        $this->actingAs($admin);

        $request = Request::create('/admin/dashboard', 'GET');
        $middleware = new RoleRedirect();

        $response = $middleware->handle($request, function () {
            return response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_user_can_access_student_routes()
    {
        $userRole = Role::create(['name' => 'user']);
        $user = User::factory()->create();
        $user->assignRole($userRole);

        $this->actingAs($user);

        $request = Request::create('/dashboard', 'GET');
        $middleware = new RoleRedirect();

        $response = $middleware->handle($request, function () {
            return response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_guest_can_pass_through()
    {
        $request = Request::create('/login', 'GET');
        $middleware = new RoleRedirect();

        $response = $middleware->handle($request, function () {
            return response('OK');
        });

        $this->assertEquals('OK', $response->getContent());
    }

    public function test_admin_json_request_to_student_route_returns_403()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole($adminRole);

        $this->actingAs($admin);

        $request = Request::create('/dashboard/api', 'GET');
        $request->headers->set('Accept', 'application/json');
        
        $middleware = new RoleRedirect();

        $response = $middleware->handle($request, function () {
            return response('Should not reach');
        });

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
