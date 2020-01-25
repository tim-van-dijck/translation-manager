<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GetTranslationsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet()
    {
        $this->seed(\TranslationsSeeder::class);
        $response = $this->get('/translations');
        $response->assertStatus(200);
        $this->assertCount(50, $response->json()['data']);
    }

    public function testPagination()
    {
        $this->seed(\TranslationsSeeder::class);
        $pageSize = 10;
        $response = $this->get("/translations?page[size]={$pageSize}&page[number]=1");
        $response->assertStatus(200);
        $this->assertCount($pageSize, $response->json()['data']);
    }
}
