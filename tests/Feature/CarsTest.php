<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarsTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/api/v1/cars/');

        $response->assertStatus(200);
    }
}
