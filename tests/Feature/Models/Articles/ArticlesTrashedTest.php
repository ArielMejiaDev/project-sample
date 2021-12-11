<?php

namespace Tests\Feature\Models\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesTrashedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tests_articles_trashed(): void
    {
        Article::factory()->count(10)->create();

        $expectedItems = 5;

        $articles = Article::factory()->count($expectedItems)->create();

        Article::destroy($articles);

        $response = $this->actingAs($this->user)
            ->getJson(route('articles.trashed'));

        $response->assertSuccessful()
            ->assertJsonCount($expectedItems, 'data');
    }
}
