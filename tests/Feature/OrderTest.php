<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class OrderTest extends TestCase
{

    use WithoutMiddleware, RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_see_orders()
    {
        $response = $this->get('/order');

        $response->assertStatus(200);
    }
}
