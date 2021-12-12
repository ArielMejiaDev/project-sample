<?php

namespace Tests\Feature\Models\Articles;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesOwnedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tests_articles_owned(): void
    {
        /** @var User $author */
        $author = $this->user;

        $articles = Article::factory()
            ->for($author, 'author')
            ->count(3)
            ->create();

        Article::factory()->count(2)->create();

        $response = $this->actingAs($author)->getJson(route('articles.owned'));

        $resource = ArticleResource::collection($articles->paginate());

        $response->assertSuccessful()
            ->assertJsonCount(3, 'data')
            ->assertResource($resource);
    }
}
