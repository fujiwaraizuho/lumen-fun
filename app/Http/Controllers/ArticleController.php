<?php

namespace App\Http\Controllers;

use App\Http\Models\Article;

class ArticleController extends Controller
{
    public function get()
    {
        $articles = Article::all();
        return response()->json($articles);
    }


    public function getById(Int $id)
    {
        $article = Article::find($id);

        if (!$article){
            return response()->json(
                ['error' => 'Unauthorized'],
                401,
                ['X-Header-One' => 'Header Value']
            );
        }

        return response()->json($article);
    }
}