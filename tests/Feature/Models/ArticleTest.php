<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tests_articles_index(): void
    {
        $expectedItems = 10;

        Article::factory()->count($expectedItems)->create();

        $response = $this->actingAs($this->user)->getJson(route('articles.index'));

        $response->assertSuccessful()
            ->assertJsonCount($expectedItems, 'data');
    }

    /** @test */
    public function it_tests_articles_show(): void
    {
        /** @var Article $article */
        $article = Article::factory()->create();

        $response = $this->actingAs($this->user)->getJson(route('articles.show', $article));

        $response->assertSuccessful()
            ->assertSee(['slug' => $article->slug])
            ->assertSee(['title' => json_decode($article->title)])
            ->assertSee(['content' => json_decode($article->content)])
            ->assertSee(['thumbnail' => json_decode($article->thumbnail)]);
    }

    /** @test */
    public function it_tests_articles_store(): void
    {
        /** @var Article $article */
        $article = Article::factory()->make();

        $response = $this->actingAs($this->user)->postJson(route('articles.store'), $article->toArray());

        $response->assertSuccessful()
            ->assertSee(['slug' => $article->slug])
            ->assertSee(['title' => json_decode($article->title)])
            ->assertSee(['content' => json_decode($article->content)])
            ->assertSee(['thumbnail' => json_decode($article->thumbnail)]);
    }

    /** @test */
    public function it_tests_articles_update(): void
    {
        /** @var Article $article */
        $article = Article::factory()->create();

        /** @var Article $newData */
        $newData = Article::factory()->make();

        $response = $this->actingAs($this->user)->putJson(route('articles.update', $article), $newData->toArray());

        $response->assertSuccessful()
            ->assertSee(['slug' => $newData->slug])
            ->assertSee(['title' => json_decode($newData->title)])
            ->assertSee(['content' => json_decode($newData->content)])
            ->assertSee(['thumbnail' => json_decode($newData->thumbnail)]);

        $article->refresh();

        $companyModelFields = collect(array_flip($article->getFillable()));

        $companyModelFields->each(
            fn ($field) => $this->assertEquals($article->{$field}, $newData->{$field})
        );
    }

    /** @test */
    public function it_tests_articles_delete(): void
    {
        /** @var Article $article */
        $article = Article::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson(route('articles.destroy', $article));

        $response->assertSuccessful()
            ->assertNoContent();

        $this->assertDatabaseMissing(Article::class, [
            'id' => $article->id,
        ]);
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function it_tests_articles_validation($invalidData, $invalidFields): void
    {
        $response = $this->actingAs($this->user)->postJson(route('articles.store'), $invalidData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors($invalidFields);
    }

    public function invalidData(): array
    {
        return [
            [
                ['title' => '','content' => '', 'thumbnail' => 1],
                ['title', 'content', 'thumbnail']
            ],
            [
                ['title' => 'hi', 'content' => 'hello', 'thumbnail' => 'hi'],
                ['title', 'content', 'thumbnail']
            ],
            [
                ['title' => 10, 'content' => 100, 'thumbnail' => 3.14],
                ['title', 'content', 'thumbnail']
            ],
        ];
    }
}
