<?php

namespace Tests\Feature\Models\Articles;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePublishTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tests_store_action_can_publish(): void
    {
        $timestamp = now();

        Carbon::setTestNow($timestamp);

        $articleData = Article::factory()->published()->make(['published_at' => null]);

        $response = $this->actingAs($this->user)
            ->postJson(route('articles.store'), $articleData->toArray());

        $this->assertNotNull($response->json('data.published_at'));

        $publishedAt = Carbon::parse($response->json('data.published_at'));

        $this->assertTrue($timestamp->isSameMinute($publishedAt));
    }

    /** @test */
    public function it_tests_store_action_can_unpublished(): void
    {
        $articleData = Article::factory()->unpublished()->make(['published_at' => null]);

        $response = $this->actingAs($this->user)
            ->postJson(route('articles.store'), $articleData->toArray());

        $this->assertNull($response->json('data.published_at'));
    }

    /** @test */
    public function it_tests_update_action_can_publish(): void
    {
        $timestamp = now();

        Carbon::setTestNow($timestamp);

        $article = Article::factory()->for($this->user, 'author')->create(['published_at' => null]);

        $articleData = Article::factory()->published()->make();

        $response = $this->actingAs($this->user)
            ->putJson(route('articles.update', $article), $articleData->toArray());

        $this->assertNotNull($response->json('data.published_at'));

        $publishedAt = Carbon::parse($response->json('data.published_at'));

        $this->assertTrue($timestamp->isSameMinute($publishedAt));
    }

    /** @test */
    public function it_tests_update_action_can_unpublished(): void
    {
        $article = Article::factory()->for($this->user, 'author')->create(['published_at' => null]);

        $articleData = Article::factory()->unpublished()->make();

        $response = $this->actingAs($this->user)
            ->putJson(route('articles.update', $article), $articleData->toArray());

        $this->assertNull($response->json('data.published_at'));
    }
}
