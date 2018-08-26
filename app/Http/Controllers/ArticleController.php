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
        $article = Article::create([
            "title" => $request->input("title"),
            "contents" => $request->input("contents"),
            "created_at" => Carbon::now("Asia/Tokyo"),
            "updated_at" => Carbon::now("Asia/Tokyo")
        ]);

        return response()->json($article);
    }


    public function updateArticle(Request $request, Int $id)
    {
        $article = Article::find($id);
        $article->title = $request->input("title");
        $article->contents = $request->input("contents");
        $article->updated_at = Carbon::now("Asia/Tokyo");
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