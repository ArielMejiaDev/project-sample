<?php

namespace Tests\Feature\Models\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesSearchTest extends TestCase
{
    use RefreshDatabase;

    protected Article $expectedArticle;

    protected function setUp(): void
    {
        parent::setUp();

        Article::factory()->create([
            'title' => 'Long live to PHP'
        ]);

        /** @var Article $expectedArticle */
        $expectedArticle = Article::factory()->create([
            'title' => '13 reason why I love Laravel'
        ]);

        $this->expectedArticle = $expectedArticle;

        Article::factory()->create([
            'title' => 'VueJS & the cool kids table'
        ]);
    }

    /**
     * @test
     * @dataProvider searchFilters
     */
    public function it_tests_articles_search($searchFilter): void
    {
        $response = $this->actingAs($this->user)
            ->getJson(route('articles.search', $searchFilter));

        $response->assertSuccessful()
            ->assertSee(['title' => $this->expectedArticle->title]);
    }

    public function searchFilters(): array
    {
        return [
            [
                ['filter[title]' => 'LARAVEL']
            ],
            [
                ['filter[title]' => 'laravel']
            ],
            [
                ['filter[title]' => 'Laravel']
            ],
        ];
    }
}
