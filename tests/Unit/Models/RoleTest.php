<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Clear any seeded roles to ensure clean state
        Role::query()->delete();
        Permission::query()->delete();
    }

    public function test_can_create_role()
    {
        $role = Role::create(['name' => 'test_admin']);

        $this->assertDatabaseHas('roles', [
            'name' => 'test_admin',
            'guard_name' => 'web'
        ]);
        $this->assertInstanceOf(Role::class, $role);
    }

    public function test_role_can_be_assigned_to_user()
    {
        $role = Role::create(['name' => 'test_user']);
        $user = User::factory()->create();

        $user->assignRole($role);

        $this->assertTrue($user->hasRole('test_user'));
        $this->assertCount(1, $user->roles);
    }

    public function test_role_can_have_permissions()
    {
        $role = Role::create(['name' => 'editor']);
        $permission1 = Permission::create(['name' => 'edit articles']);
        $permission2 = Permission::create(['name' => 'delete articles']);

        $role->givePermissionTo($permission1, $permission2);

        $this->assertTrue($role->hasPermissionTo('edit articles'));
        $this->assertTrue($role->hasPermissionTo('delete articles'));
        $this->assertCount(2, $role->permissions);
    }

    public function test_users_with_role_have_role_permissions()
    {
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'publish articles']);
        $role->givePermissionTo($permission);

        $user = User::factory()->create();
        $user->assignRole($role);

        $this->assertTrue($user->hasPermissionTo('publish articles'));
    }
}
