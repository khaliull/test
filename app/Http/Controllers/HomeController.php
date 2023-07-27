<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Fact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $facts = Fact::select('facts.content')->inRandomOrder()->limit(3)->get();

        return view('welcome', [
          'title' => 'Главная',
          'facts' => $facts,
        ]);
    }

    public function articles()
    {
        $articles = Article::where('status', 1)->latest()->get();

        return view('articles.index', [
          'title' => 'Последние новости сервиса',
          'articles' => $articles
        ]);
    }

    public function articlesShow($title)
    {

        $article = Article::where('title', $title)->latest()->first();

        abort_unless($article, 404);

        return view('articles.show', [
          'title' => $title,
          'article' => $article
        ]);
    }
}
