<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);
    }

    public function test_user_can_assign_role()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);

        $user->assignRole($role);

        $this->assertTrue($user->hasRole('admin'));
    }

    public function test_user_is_online_check()
    {
        $user = User::factory()->create();
        
        // Simulate session
        DB::table('sessions')->insert([
            'id' => 'session_id_123',
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0',
            'payload' => 'payload',
            'last_activity' => now()->timestamp
        ]);

        $this->assertTrue($user->isOnline());

        // Simulate offline (old session)
        DB::table('sessions')->where('user_id', $user->id)->update([
            'last_activity' => now()->subMinutes(10)->timestamp
        ]);

        $this->assertFalse($user->isOnline());
    }
}
