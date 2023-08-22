<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ArticleStoreRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->respondWithResourceCollection(ArticleResource::collection(Article::all()));
    }

    public function show(Article $article)
    {
        return $this->respondWithResource(new ArticleResource($article));

    }

    public function store(ArticleStoreRequest $request)
    {
        $article = Article::create($request->all());


        return $this->respondCreated(new ArticleResource($article));
//        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
