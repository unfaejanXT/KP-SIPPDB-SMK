<?php

namespace Tests\Unit\Models;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_permission()
    {
        $permission = Permission::create(['name' => 'edit articles']);

        $this->assertDatabaseHas('permissions', [
            'name' => 'edit articles',
            'guard_name' => 'web'
        ]);
        $this->assertInstanceOf(Permission::class, $permission);
    }
}
