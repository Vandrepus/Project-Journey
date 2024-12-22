<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Update the article
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Redirect back to the articles list with a success message
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Delete the article
        $article->delete();

        // Redirect back to the articles list with a success message
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'admin_id' => auth()->id(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function list()
    {
        $articles = Article::latest()->paginate(12);
        return view('user.articles.list', compact('articles'));
    }

    public function show(Article $article)
    {
        $articles = Article::latest()->paginate(9);
        return view('user.articles.show', compact('article'));
    }
}
