<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Šis kontrolieris pārvalda rakstus, kas ietver rakstu izveidi, rediģēšanu,
 * dzēšanu un attēlošanu gan administrācijai, gan lietotājiem.
 *
 * This controller manages articles, including creating, editing, deleting, 
 * and displaying them for both admins and users.
 */
class ArticleController extends Controller
{
    /**
     * Parāda visu rakstu sarakstu administrācijas panelī ar lapošanu.
     *
     * Displays a paginated list of all articles in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Parāda formu jaunam rakstam administrācijā.
     *
     * Displays the form for creating a new article in the admin panel.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Parāda formu esoša raksta rediģēšanai.
     *
     * Displays the form for editing an existing article.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Atjaunina rakstu ar jaunu saturu un nosaukumu.
     *
     * Updates an article with new content and title.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Dzēš norādīto rakstu.
     *
     * Deletes the specified article.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    /**
     * Saglabā jaunu rakstu datubāzē.
     *
     * Stores a newly created article in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Parāda rakstu sarakstu lietotāja skatījumā.
     *
     * Displays a list of articles for the user.
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        $articles = Article::latest()->paginate(12);
        return view('user.articles.list', compact('articles'));
    }

    /**
     * Parāda atsevišķu rakstu lietotāja skatījumā.
     *
     * Displays a specific article for the user.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\View\View
     */
    public function show(Article $article)
    {
        return view('user.articles.show', compact('article'));
    }
}
