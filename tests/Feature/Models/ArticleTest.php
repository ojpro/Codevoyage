<?php

it('able to create new articles',function(){
    // create a dummy article
    $article = \App\Models\Article::factory()->create();

    // check that's has been added to the database
    $this->assertDatabaseCount('articles',1);
    $this->assertDatabaseHas('articles',$article->toArray());
});
