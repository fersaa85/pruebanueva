<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // Run the DatabaseSeeder...
        $this->seed();

        $response = $this->postJson('/api/employees', [
            "name" => "name",
            "email" => "fersaavedra85@hotmail.com",
            "address" => "oniquina 44 ",
            "date" => "02/07/2023",
            "skills" => ["javascript"],
            "job" => "job",
            "skillValues" => [
                "Javascript" => "5",
            ]

        ]);

        $this->assertDatabaseCount('employess', 1);
        $response->assertStatus(201);
    }
}
