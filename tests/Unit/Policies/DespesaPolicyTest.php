<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Models\User;
use App\Models\Despesa;
use App\Policies\DespesaPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DespesaPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_method_allows_owner()
    {
        $user = User::factory()->create();
        $despesa = Despesa::factory()->create(['user_id' => $user->id]);

        $policy = new DespesaPolicy();

        $this->assertTrue($policy->view($user, $despesa));
    }

    public function test_view_method_denies_non_owner()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $despesa = Despesa::factory()->create(['user_id' => $user2->id]);

        $policy = new DespesaPolicy();

        $this->assertFalse($policy->view($user1, $despesa));
    }

    public function test_update_method_allows_owner()
    {
        $user = User::factory()->create();
        $despesa = Despesa::factory()->create(['user_id' => $user->id]);

        $policy = new DespesaPolicy();

        $this->assertTrue($policy->update($user, $despesa));
    }

    public function test_update_method_denies_non_owner()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $despesa = Despesa::factory()->create(['user_id' => $user2->id]);

        $policy = new DespesaPolicy();

        $this->assertFalse($policy->update($user1, $despesa));
    }

    public function test_delete_method_allows_owner()
    {
        $user = User::factory()->create();
        $despesa = Despesa::factory()->create(['user_id' => $user->id]);

        $policy = new DespesaPolicy();

        $this->assertTrue($policy->delete($user, $despesa));
    }

    public function test_delete_method_denies_non_owner()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $despesa = Despesa::factory()->create(['user_id' => $user2->id]);

        $policy = new DespesaPolicy();

        $this->assertFalse($policy->delete($user1, $despesa));
    }
}
