<?php

namespace Tests\Feature;

use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddMoneyTest extends TestCase
{
    public function test_it_adds_money_to_a_user_wallet_and_returns_a_reference_number()
    {
        $user_id = 1;
        $amount = 500;
        Wallet::factory()->create(['user_id' => $user_id, 'balance' => 1000]);

        $response = $this->post('/api/add-money', [
            'user_id' => $user_id,
            'amount' => $amount,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['reference_id']);

        $this->assertEquals($amount + 1000, Wallet::where('user_id', $user_id)->first()->balance);
    }

    public function test_get_not_found_with_invalid_user_id(){
        $response = $this->post('/api/add-money', [
            'user_id' => 234,
            'amount' => 500,
        ]);

        $response->assertNotFound();
    }

    public function test_it_throw_validation_error_if_user_id_is_not_set(){
        $response = $this->post('/api/add-money', [
            'amount' => 200,
        ]);

        $response->assertSessionHasErrors('user_id')
            ->assertStatus(302);
    }

    public function test_it_throw_validation_error_if_amount_type_is_not_valid(){
        $response = $this->post('/api/add-money', [
            'user_id' => 1,
            'amount' => 'not valid',
        ]);

        $response->assertSessionHasErrors('amount')
            ->assertStatus(302);
    }

    public function test_it_throw_validation_error_if_amount_is_not_set(){
        $response = $this->post('/api/add-money', [
            'user_id' => 234,
        ]);

        $response->assertSessionHasErrors('amount')
            ->assertStatus(302);
    }
}
