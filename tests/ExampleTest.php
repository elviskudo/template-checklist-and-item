<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetHistory()
    {
        $this->json('GET', '/api/v1/checklists/histories')
            ->seeJson();
    }

    public function testHistory()
    {
        $response = $this->call('GET', '/api/v1/checklists/histories');

        $this->assertEquals(200, $response->status());
    }
    
    public function testAddChecklist()
    {
        $parameters = [
            'loggable_type' => 'items',
        ];

        $this->json('POST', 'api/v1/checklists/histories', $parameters)
            ->seeJson();
    }

    public function testDatabase()
    {
        $this->seeInDatabase('histories', ['action' => 'assign']);
    }
}
