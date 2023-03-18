<?php

namespace Tests\Feature;

use App\Models\Wallet;
use Tests\TestCase;

class GetBalanceTest extends TestCase
{

    public function test_it_returns_the_balance_for_a_user()
    {
        Wallet::factory()->create(['user_id' => 1, 'balance' => 5000]);

        $response = $this->get('/api/balance/?user_id=1');

        $response->assertStatus(200);
        $response->assertJson(['balance' => 5000]);
    }


    public function test_get_balance_wallet_not_found()
    {
        $response = $this->get('/api/balance?user_id=123');

        $response->assertNotFound();
    }

}
