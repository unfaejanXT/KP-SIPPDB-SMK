<?php

namespace Tests\Unit\Models;

use App\Models\Operator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_operator()
    {
        $operator = Operator::create([
            'nama_operator' => 'Op1',
            'jabatan' => 'Staff',
            'noHP' => '08123'
        ]);

        $this->assertDatabaseHas('operator', ['nama_operator' => 'Op1']);
    }
}
