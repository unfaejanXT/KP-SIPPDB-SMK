<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_role()
    {
        $role = Role::create(['name' => 'admin']);

        $this->assertDatabaseHas('roles', [
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        $this->assertInstanceOf(Role::class, $role);
    }
}
