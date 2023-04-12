<?php

it('able to create new articles', function () {
    // create a dummy article
    $article = \App\Models\Article::factory()->create();

    // check that's has been added to the database
    $this->assertDatabaseCount('articles', 1);
    $this->assertDatabaseHas('articles', [
        'title'=>$article['title'],
        'thumbnail'=>$article['thumbnail'],
        'content'=>$article['content']
    ]);
});

it('unable to perform critical action unless is auth', function () {

    // try to visit create article page
    $response = $this->get(route('article.create'));

    // will be able to access it
    $response->assertRedirect(route('login'));

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

    // dummy user
    $user = \App\Models\User::factory()->create();

    // send create request
    $response = $this->actingAs($user)->post(route('article.store'), $article);

    // assert won't process creation and return an error
    $response->assertInvalid(['title' => "The title field must be at least 8 characters."]);
});

it('creates new article', function () {

    // dummy image
    $image = \Illuminate\Http\UploadedFile::fake()->image('image.png');

    // make a dummy article
    $article = \App\Models\Article::factory()->make([
        'thumbnail' => $image
    ])->toArray();

    // dummy user
    $user = \App\Models\User::factory()->create();

    // send creation request
    $response = $this->actingAs($user)->post(route('article.store'), $article);

    // also does exist in the database
    $this->assertDatabaseCount('articles', 1);
    $this->assertDatabaseHas('articles', [
        'title' => $article['title'],
        'content' => $article['content']
    ]);
});

it('validates the update requests', function () {
    // demo article
    $old_article = \App\Models\Article::factory()->create();

    // invalid article
    $invalid_article = [
        'content' => 'less than 50 chars contents and no title',
    ];

    // dummy user
    $user = \App\Models\User::factory()->create();

    // send update request
    $response = $this->actingAs($user)->put(route('article.update', $old_article), $invalid_article);

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

    // dummy user
    $user = \App\Models\User::factory()->create();

    // send request
    $response = $this->actingAs($user)->put(route('article.update', $old_article), $new_article);

    // assert updated in the database
    $this->assertDatabaseHas('articles', $new_article);
    $this->assertDatabaseMissing('articles', $old_article->toArray());
});

test('to delete article', function () {
    // article
    $article = \App\Models\Article::factory()->create();

    // dummy user
    $user = \App\Models\User::factory()->create();

    // send delete request
    $response = $this->actingAs($user)->delete(route('article.destroy', $article));

    // assert database is empty and article removed
    $this->assertDatabaseCount('articles', 0);
    $this->assertDatabaseMissing('articles', $article->toArray());
});

it('render create view', function () {
    // dummy user
    $user = \App\Models\User::factory()->create();

    // visit create route
    $response = $this->actingAs($user)->get(route('article.create'));

    // assert that is shows the create view
    $response->assertViewIs('article.create');
});

it('render article view', function () {
    // article for testing
    $article = \App\Models\Article::factory()->create();

    // dummy user
    $user = \App\Models\User::factory()->create();

    // visit create route
    $response = $this->actingAs($user)->get(route('article.show', $article));

    // assert that is shows the create view
    $response->assertViewIs('article.show');
});

it('render update view', function () {
    // article for testing
    $article = \App\Models\Article::factory()->create();

    // dummy user
    $user = \App\Models\User::factory()->create();

    // visit create route
    $response = $this->actingAs($user)->get(route('article.edit', $article));

    // assert that is shows the create view
    $response->assertViewIs('article.edit');
});
