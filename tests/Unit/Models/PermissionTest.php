<?php

namespace Tests\Unit\Models;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Clear any seeded data to ensure clean state
        \App\Models\Role::query()->delete();
        \App\Models\Permission::query()->delete();
    }

    public function test_can_create_permission()
    {
        $permission = Permission::create(['name' => 'edit articles']);

        $this->assertDatabaseHas('permissions', [
            'name' => 'edit articles',
            'guard_name' => 'web'
        ]);
        $this->assertInstanceOf(Permission::class, $permission);
    }

    public function test_permission_can_be_assigned_to_role()
    {
        $permission = Permission::create(['name' => 'manage users']);
        $role = Role::create(['name' => 'admin']);

        $role->givePermissionTo($permission);

        $this->assertTrue($role->hasPermissionTo('manage users'));
        $this->assertCount(1, $role->permissions);
    }

    public function test_can_create_multiple_permissions()
    {
        $permissions = [
            Permission::create(['name' => 'create posts']),
            Permission::create(['name' => 'edit posts']),
            Permission::create(['name' => 'delete posts']),
        ];

        $this->assertCount(3, Permission::all());
        foreach ($permissions as $permission) {
            $this->assertInstanceOf(Permission::class, $permission);
        }
    }
}
