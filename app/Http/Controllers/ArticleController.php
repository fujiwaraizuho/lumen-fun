<?php

namespace App\Http\Controllers;

use App\Http\Models\Article;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::all();

        return response()->json($article);
    }


    public function getArticleById(Int $id)
    {
        $article = Article::find($id);

        return response()->json($article);
    }


    public function createArticle(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article);
    }


    public function updateArticle(Request $request, Int $id)
    {
        $article = Article::find($id);

        if ($request->input("title")) {
            $article->title = $request->input("title");
        }

        if ($request->input("contents")) {
            $article->contents = $request->input("contents");
        }

        $article->save();

        return response()->json($article);
    }


    public function deleteArticle(Int $id)
    {
        $article = Article::find($id);
        $article->delete();

        return response()->json($article);
    }
}