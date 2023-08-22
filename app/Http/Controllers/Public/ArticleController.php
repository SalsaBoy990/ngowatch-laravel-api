<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    /**
     * Return article item as public page
     *
     * @param  Article  $article
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show(Article $article): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.public.article.show')->with(
            [
                'article' => $article
            ]
        );
    }
}
