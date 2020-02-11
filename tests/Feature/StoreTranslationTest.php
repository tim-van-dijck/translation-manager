<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreTranslationTest extends TestCase
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

    public function testValidation()
    {
        $data = [
            'key' => 0,
            'languages' => [
                'nl' => ['translation' => 'test nl'],
                'en' => ['translation' => 'test en'],
                'fr' => ['translation' => 'test fr'],
                'de' => ['translation' => 'test de'],
            ]
        ];
        $response = $this->post('/translations', $data, ['Accept' => 'application/json']);
        $response->assertStatus(422);
    }

    public function testUnique()
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
        $this->post('/translations', $data);
        $response = $this->post('/translations', $data, ['Accept' => 'application/json']);
        $response->assertStatus(422);
    }
}
