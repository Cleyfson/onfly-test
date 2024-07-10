<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Despesa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DespesaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_despesas()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Despesa::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/despesas');

        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertCount(5, $responseData);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'descricao', 'data', 'valor', 'user' => ['id', 'name', 'email']],
            ],
        ]);
    }

    public function test_store_creates_despesa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'descricao' => 'Nova Despesa',
            'data' => now()->toDateString(),
            'valor' => 100.50,
        ];

        $response = $this->postJson('/api/despesas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
        $this->assertDatabaseHas('despesas', [
            'descricao' => 'Nova Despesa',
            'data' => now()->toDateString() . ' 00:00:00',
            'valor' => 100.50,
            'user_id' => $user->id,
        ]);
    }

    public function test_update_updates_despesa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $despesa = Despesa::factory()->create(['user_id' => $user->id]);

        $updateData = [
            'descricao' => 'Despesa Atualizada',
            'valor' => 150.75,
        ];

        $response = $this->putJson("/api/despesas/{$despesa->id}", $updateData);

        $response->assertStatus(200)->assertJsonFragment($updateData);
        $this->assertDatabaseHas('despesas', array_merge($updateData, ['id' => $despesa->id]));
    }

    public function test_destroy_deletes_despesa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $despesa = Despesa::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/despesas/{$despesa->id}");

        $response->assertStatus(200)->assertJson(['message' => 'Despesa deletada com sucesso']);
        $this->assertDatabaseMissing('despesas', ['id' => $despesa->id]);
    }

    public function test_show_returns_despesa()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $despesa = Despesa::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson("/api/despesas/{$despesa->id}");

        $response->assertStatus(200)->assertJson([
            'id' => $despesa->id,
            'descricao' => $despesa->descricao,
            'data' => $despesa->data->format('Y-m-d'),
            'valor' => (float) $despesa->valor,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
