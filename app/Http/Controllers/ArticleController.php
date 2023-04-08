<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // fetch latest [n] blog's articles
        $articles = Article::paginate(20);

        // return the articles to the home page
        return view('home', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return create view
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // add the new article
        Article::create($request->all());

        // return success response
        return response(['message' => 'New Article Added'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // show article view
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // edit article's view
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // assert is does exist
        $fetched_article = Article::findOrFail($article['id']);

        // update the details
        $fetched_article->update($request->all());

        // send back a response
        return response(['message' => 'Article has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // check the existence
        $article_to_delete = Article::findOrFail($article['id']);

        // delete the article
        $article_to_delete->delete();

        // send success response
        return response(['message' => 'Article has been deleted']);
    }
}
