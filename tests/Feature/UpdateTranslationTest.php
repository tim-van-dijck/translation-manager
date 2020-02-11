<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTranslationTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testStore()
    {
        $data = [
            'key' => 'test.test',
            'languages' => [
                'nl' => ['translation' => 'test nl'],
                'en' => ['translation' => 'test en'],
                'fr' => ['translation' => 'test fr'],
                'de' => ['translation' => 'test de'],
            ]
        ];
        $return = [
            'key' => 'test.test',
            'languages' => [
                'nl' => 'test nl',
                'en' => 'test en',
                'fr' => 'test fr',
                'de' => 'test de',
            ]
        ];
        $response = $this->post('/translations', $data);
        $response->assertStatus(200);
        $this->assertSame($return, $response->json());
    }
}
