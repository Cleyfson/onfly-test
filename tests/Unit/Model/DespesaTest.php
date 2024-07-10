<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Despesa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class DespesaTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_despesa()
    {
        $user = User::factory()->create();

        $despesa = Despesa::factory()->create([
            'descricao' => 'Nova Despesa',
            'data' => Carbon::now()->subDays(1)->toDateString(),
            'valor' => 100.50,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('despesas', [
            'descricao' => 'Nova Despesa',
            'valor' => 100.50,
            'user_id' => $user->id,
        ]);

        $this->assertEquals('Nova Despesa', $despesa->descricao);
        $this->assertEquals(Carbon::now()->subDays(1)->toDateString(), $despesa->data->toDateString());
        $this->assertEquals(100.50, $despesa->valor);
        $this->assertEquals($user->id, $despesa->user_id);
    }
}
