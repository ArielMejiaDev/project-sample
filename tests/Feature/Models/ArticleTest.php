<?php

namespace Tests\Feature\Models;

use App\Http\Resources\ArticleResource;
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

        $resource = ArticleResource::collection(Article::query()->with('author')->paginate());

        $response->assertResource($resource);
    }

    /** @test */
    public function it_tests_articles_show(): void
    {
        /** @var Article $article */
        $article = Article::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->getJson(route('articles.show', $article));

        $resource = ArticleResource::make($article->load('author'));
        $response->assertResource($resource);
    }

    /** @test */
    public function it_tests_articles_store(): void
    {
        /** @var Article $article */
        $article = Article::factory()->make(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->postJson(route('articles.store'), $article->toArray());

        $resource = ArticleResource::make($article->load('author'));
        $response->assertResource($resource);
    }

    /** @test */
    public function it_tests_articles_update(): void
    {
        /** @var Article $article */
        $article = Article::factory()->create(['author_id' => $this->user->id]);

        /** @var Article $newData */
        $newData = Article::factory()->make(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->putJson(route('articles.update', $article), $newData->toArray());

        $article->refresh();

        $resource = ArticleResource::make($article->load('author'));

        $response->assertResource($resource);

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
