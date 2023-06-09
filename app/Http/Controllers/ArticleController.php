<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // fetch latest [n] blog's articles
        $articles = Article::paginate(10);

        // return the articles to the home page
        return view('home', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: need improvement
        // previous page link
        $previous_page = redirect()->back()->getTargetUrl();

        // return create view
        return view('article.create', compact('previous_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // check if the thumbnail is provided
        if ($request->file('thumbnail')) {
            try {
                // try to upload
                $path = UploadImage::upload($request->file('thumbnail'))['path'];
            } catch (\Exception $e) {
                // in case any error log it and return error message
                Log::info($e->getMessage());
                return redirect()->back()->with(['error' => 'Unable to upload the image please try again']);
            }
        }

        // add the new article
        Article::create([
            'title' => $request->get('title'),
            'thumbnail' => $path ?? '',
            'content' => $request->get('content')
        ]);

        // redirect with success response
        return redirect()->route('home')
            ->with('message', 'New article added');
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
        // previous page link
        $previous_page = redirect()->back()->getTargetUrl();

        // edit article's view
        return view('article.edit', compact('article', 'previous_page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // assert is does exist
        $fetched_article = Article::findOrFail($article['id']);

        // check if that the thumbnail does exist
        if ($request->file('thumbnail')) {
            try {
                // upload
                $path = UploadImage::upload($request->file('thumbnail'))['path'];
            } catch (\Exception $e) {
                // handle errors
                Log::info($e->getMessage());
                return redirect()->back()->with(['error' => 'Unable to upload the image please try again']);
            }
        } else {
            // get the article thumbnail url in case the thumbnail has not changed
            $path = $fetched_article->thumbnail;
        }

        // update the details
        $fetched_article->update([
            'title' => $request->get('title'),
            'thumbnail' => $path ?? null,
            'content' => $request->get('content')
        ]);

        // redirect to the article page with success message
        return redirect()->route('article.show', $article)
            ->with(['message' => 'Article has been updated']);
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

        // redirect with success response
        return redirect()->route('home')
            ->with('message', 'Article has been deleted');
    }
}
