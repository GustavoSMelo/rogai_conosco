<?php

namespace Tests\Unit;

use App\Services\AiService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiServiceTest extends TestCase
{
    public function test_find_best_pray_match_returns_null_on_http_failure(): void
    {
        Http::fake([
            config('services.openrouter.url') => Http::response(null, 500),
        ]);

        $result = app(AiService::class)->findBestPrayMatch('catholic', 'peace and strength');

        $this->assertNull($result);
    }

    public function test_find_best_pray_match_returns_null_on_empty_response(): void
    {
        Http::fake([
            config('services.openrouter.url') => Http::response([]),
        ]);

        $result = app(AiService::class)->findBestPrayMatch('catholic', 'healing');

        $this->assertNull($result);
    }

    public function test_find_best_pray_match_returns_null_on_missing_choices(): void
    {
        Http::fake([
            config('services.openrouter.url') => Http::response(['choices' => []]),
        ]);

        $result = app(AiService::class)->findBestPrayMatch('catholic', 'healing');

        $this->assertNull($result);
    }

    public function test_find_best_pray_match_returns_parsed_json_from_code_block(): void
    {
        Http::fake([
            config('services.openrouter.url') => Http::response([
                'choices' => [
                    ['message' => ['content' => "Here is the matching prayer:\n```json\n{\"title\":\"Peace Prayer\",\"category\":\"peace\",\"subcategory\":[\"calm\"],\"body\":\"Lord, grant peace.\",\"tags\":[\"peace\",\"calm\"]}\n```"]],
                ],
            ]),
        ]);

        $result = app(AiService::class)->findBestPrayMatch('catholic', 'peace');

        $this->assertIsArray($result);
        $this->assertSame('Peace Prayer', $result['title']);
        $this->assertSame('peace', $result['category']);
        $this->assertSame(['calm'], $result['subcategory']);
        $this->assertSame('Lord, grant peace.', $result['body']);
        $this->assertSame(['peace', 'calm'], $result['tags']);
    }

    public function test_find_best_pray_match_returns_parsed_json_from_plain_response(): void
    {
        Http::fake([
            config('services.openrouter.url') => Http::response([
                'choices' => [
                    ['message' => ['content' => '{"title":"Healing Prayer","category":"healing","subcategory":[],"body":"God, heal us.","tags":["healing"]}']],
                ],
            ]),
        ]);

        $result = app(AiService::class)->findBestPrayMatch('catholic', 'heal');

        $this->assertIsArray($result);
        $this->assertSame('Healing Prayer', $result['title']);
    }
}
