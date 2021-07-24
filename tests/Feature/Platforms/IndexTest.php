<?php

namespace Tests\Feature\Platforms;

use App\Models\Platform;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_empty(): void
    {
        $response = $this->get('/api/platforms');

        $response->assertStatus(200)
            ->assertExactJson([
                'current_page' => 1,
                'data' => [],
                'first_page_url' => 'http://localhost/api/platforms?page=1',
                'from' => NULL,
                'last_page' => 1,
                'last_page_url' => 'http://localhost/api/platforms?page=1',
                'links' => [
                    0 => [
                        'active' => false,
                        'label' => '&laquo; Previous',
                        'url' => NULL,
                    ],
                    1 => [
                        'active' => true,
                        'label' => '1',
                        'url' => 'http://localhost/api/platforms?page=1',
                    ],
                    2 => [
                        'active' => false,
                        'label' => 'Next &raquo;',
                        'url' => NULL,
                    ],
                ],
                'next_page_url' => NULL,
                'path' => 'http://localhost/api/platforms',
                'per_page' => 15,
                'prev_page_url' => NULL,
                'to' => NULL,
                'total' => 0,
            ]);
    }

    public function test_index_result(): void
    {
        $this->mockPlatform();
        $platform = Platform::first();

        $response = $this->get('/api/platforms');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    [
                        'id' => $platform->id,
                        'name' => $platform->name,
                        'image_url' => $platform->image_url,
                        'created_at' => $platform->created_at,
                        'updated_at' => $platform->updated_at,
                        'deleted_at' => $platform->deleted_at,
                    ]
                ]
            ]);
    }

    // mocks
    private function mockPlatform(int $count = 1): void
    {
        Platform::factory()->count($count)->create();
    }
}
