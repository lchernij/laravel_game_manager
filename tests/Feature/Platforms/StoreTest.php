<?php

namespace Tests\Feature\Platforms;

use App\Models\Platform;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider provideInvalidInputs
     */
    public function test_validate_fields($payload, $expected): void
    {
        $this->postJson('api/platforms', $payload)
            ->assertStatus(422)
            ->assertExactJson($expected);
    }

    public function test_validate_unique(): void
    {
        $this->mockPlatform();
        $platform = Platform::first();

        $payload = [
            "name" => $platform->name
        ];

        $this->postJson('api/platforms', $payload)
            ->assertStatus(422)
            ->assertExactJson([
                'errors' => [
                    'name' => [
                        'The name has already been taken.',
                    ],
                ],
                'message' => 'The given data was invalid.',
            ]);
    }

    public function test_store(): void
    {
        $payload = [
            'name' => 'Sony',
            'image_url' => 'localhost/images/sony.png'
        ];

        $response = $this->postJson('api/platforms', $payload)
            ->assertStatus(201);

        $platform = Platform::where('name', $payload['name'])->first();

        $response->assertExactJson([
            'created_at' => $platform->created_at,
            'id' => $platform->id,
            'image_url' => $platform->image_url,
            'name' => $platform->name,
            'updated_at' => $platform->updated_at,
        ]);
    }

    // mocks
    private function mockPlatform(int $count = 1): void
    {
        Platform::factory()->count($count)->create();
    }

    /**
     * Provider from test_validate_fields
     */
    public function provideInvalidInputs(): array
    {
        return [
            "required" => [
                "payload" => [],
                "expected" => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'name' => [
                            'The name field is required.',
                        ],
                    ],
                ],
            ],
            "max" => [
                "payload" => [
                    "name" => Str::random(65),
                    "image_url" => Str::random(257)
                ],
                "expected" => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'name' => [
                            'The name must not be greater than 64 characters.',
                        ],
                        'image_url' => [
                            'The image url must not be greater than 256 characters.',
                        ],
                    ],
                ],
            ],
        ];
    }
}
