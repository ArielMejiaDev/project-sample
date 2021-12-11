<?php

namespace Tests\Feature\Models\Articles;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesTest extends TestCase
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
        $article = Article::factory()->for($this->user, 'author')->create();

        $response = $this->actingAs($this->user)->getJson(route('articles.show', $article));

        $resource = ArticleResource::make($article->load('author'));

        $response->assertResource($resource);
    }

    /** @test */
    public function it_tests_articles_store(): void
    {
        /** @var Article $article */
        $article = Article::factory()->for($this->user, 'author')->make();

        $response = $this->actingAs($this->user)
            ->postJson(route('articles.store'), $article->toArray());

        $resource = ArticleResource::make(Article::query()->first()->load('author'));

        $response->assertResource($resource);
    }

    /** @test */
    public function it_tests_articles_update(): void
    {
        /** @var Article $article */
        $article = Article::factory()->for($this->user, 'author')->create();

        /** @var Article $newData */
        $newData = Article::factory()->make(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->putJson(route('articles.update', $article), $newData->toArray());

        $article->refresh();

        $resource = ArticleResource::make($article->load('author'));

        $response->assertResource($resource);

        $this->assertModelEquals($newData, $article);
    }

    /** @test */
    public function it_tests_articles_delete(): void
    {
        /** @var Article $article */
        $article = Article::factory()->for($this->user, 'author')->create();

        $response = $this->actingAs($this->user)
            ->deleteJson(route('articles.destroy', $article));

        $response->assertSuccessful()
            ->assertNoContent();

        $this->assertEquals(
            Article::query()->onlyTrashed()->first()->id,
            $article->id
        );
    }

    /** @test */
    public function it_tests_soft_deletes_with_rename_feature(): void
    {
        $titleName = 'A day in life of Doe';

        /** @var Article $article */
        $article = Article::factory()->for($this->user, 'author')->create([
            'title' => $titleName,
        ]);

        $response = $this->actingAs($this->user)
            ->deleteJson(route('articles.destroy', $article));

        $response->assertNoContent();

        $this->assertEquals(
            Article::query()->onlyTrashed()->first()->title,
            "{$titleName} - deleted"
        );

        /** @var Article $article */
        $anotherArticle = Article::factory()->for($this->user, 'author')->create([
            'title' => $titleName,
        ]);

        $anotherResponse = $this->actingAs($this->user)
            ->deleteJson(route('articles.destroy', $anotherArticle));

        $this->assertEquals(
            Article::query()->onlyTrashed()->find(2)->title,
            "{$titleName} - deleted 2"
        );
    }

    /** @test */
    public function it_tests_update_policy(): void
    {
        $article = Article::factory()->create();

        $newData = Article::factory()->for($this->user, 'author')->make();

        $response = $this->actingAs($this->user)
            ->putJson(route('articles.update', $article), $newData->toArray());

        $response->assertForbidden();
    }

    /** @test */
    public function it_tests_delete_policy(): void
    {
        $article = Article::factory()->create();

        $newData = Article::factory()->for($this->admin, 'author')->make();

        $response = $this->actingAs($this->user)
            ->putJson(route('articles.update', $article), $newData->toArray());

        $response->assertForbidden();
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function it_tests_articles_validation($invalidData, $invalidFields): void
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('articles.store'), $invalidData);

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
