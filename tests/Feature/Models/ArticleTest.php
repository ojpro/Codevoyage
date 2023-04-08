<?php

it('able to create new articles', function () {
    // create a dummy article
    $article = \App\Models\Article::factory()->create();

    // check that's has been added to the database
    $this->assertDatabaseCount('articles', 1);
    $this->assertDatabaseHas('articles', $article->toArray());
});

test('show articles on the home page', function () {
    // create dummy article for testing
    $article = \App\Models\Article::factory()->create();

    // visit the home page
    $response = $this->get('/')->assertOk();

    // assert that article is displayed on the page
    $response->assertSee($article->title, $article->content);
});

test('validate creation requests', function () {
    // make a dummy article to use it for test
    $article = \App\Models\Article::factory()->make([
        'title' => 'error'
    ])->toArray();

    // send create request
    $response = $this->post(route('article.store'), $article);

    // assert won't process creation and return an error
    $response->assertInvalid(['title' => "The title field must be at least 8 characters."]);
});

it('creates new article', function () {
    // make a dummy article
    $article = \App\Models\Article::factory()->make()->toArray();

    // send creation request
    $response = $this->post(route('article.store'), $article);

    // validate that the article added
    $response->assertCreated();

    // also does exist in the database
    $this->assertDatabaseHas('articles', $article);
});

it('validates the update requests', function () {
    // demo article
    $old_article = \App\Models\Article::factory()->create();

    // invalid article
    $invalid_article = [
        'content' => 'less than 50 chars contents and no title',
    ];

    // send update request
    $response = $this->put(route('article.update', $old_article), $invalid_article);

    // assert that the request has invalid article details
    $response->assertInvalid();

    // check that there is no update on the database
    $this->assertDatabaseMissing('articles', $invalid_article);
});

test('updates article details', function () {
    // create a demo article
    $old_article = \App\Models\Article::factory()->create();

    // new article details
    $new_article = [
        "title" => fake()->text(50),
        "content" => fake()->realText()
    ];

    // send request
    $response = $this->put(route('article.update', $old_article), $new_article);

    // assert OK
    $response->assertOk();

    // assert updated in the database
    $this->assertDatabaseHas('articles', $new_article);
    $this->assertDatabaseMissing('articles', $old_article->toArray());
});

test('to delete article', function () {
    // article
    $article = \App\Models\Article::factory()->create();

    // send delete request
    $response = $this->delete(route('article.destroy', $article));

    // check success
    $response->assertOk();

    // assert database is empty and article removed
    $this->assertDatabaseCount('articles', 0);
    $this->assertDatabaseMissing('articles', $article->toArray());
});

it('render create view', function () {
    // visit create route
    $response = $this->get(route('article.create'));

    // assert that is shows the create view
    $response->assertViewIs('article.create');
});

it('render article view', function () {
    // article for testing
    $article = \App\Models\Article::factory()->create();

    // visit create route
    $response = $this->get(route('article.show', $article));

    // assert that is shows the create view
    $response->assertViewIs('article.show');
});

it('render update view', function () {
    // article for testing
    $article = \App\Models\Article::factory()->create();

    // visit create route
    $response = $this->get(route('article.edit', $article));

    // assert that is shows the create view
    $response->assertViewIs('article.edit');
});
