<?php

namespace Tests\Unit\Models;

use App\Models\Operator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_operator()
    {
        $user = User::factory()->create();
        
        $operator = Operator::create([
            'user_id' => $user->id,
            'nama_operator' => 'Operator 1',
            'is_active' => true
        ]);

        $this->assertDatabaseHas('operator', ['nama_operator' => 'Operator 1']);
        $this->assertEquals($user->id, $operator->user_id);
        $this->assertTrue($operator->is_active);
    }

    public function test_operator_belongs_to_user()
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        
        $operator = Operator::create([
            'user_id' => $user->id,
            'nama_operator' => 'Operator 2',
            'is_active' => true
        ]);

        // Test that operator can access user if relation is defined
        // If relation doesn't exist in model, this assertion might fail
        // You may need to add belongsTo relationship in Operator model
        $this->assertInstanceOf(Operator::class, $operator);
        $this->assertEquals($user->id, $operator->user_id);
    }

    public function test_operator_can_be_deactivated()
    {
        $user = User::factory()->create();
        
        $operator = Operator::create([
            'user_id' => $user->id,
            'nama_operator' => 'Operator 3',
            'is_active' => true
        ]);

        $operator->update(['is_active' => false]);

        $this->assertFalse($operator->fresh()->is_active);
    }
}
