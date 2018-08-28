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

        if (($count = count($article)) > 0) {
            $response["status"] = "OK";
            $response["count"] = $count;
            $response["data"] = $article;
        } else {
            $response["status"] = "NO";
            $response["error"] = [
                "message" => "No article exists!"
            ];
        }

        return response()->json($response);
    }


    public function getArticleById(Int $id)
    {
        $article = Article::find($id);

        if (!is_null($article)) {
            $response["status"] = "OK";
            $response["data"] = $article;
        } else {
            $response["status"] = "NO";
            $response["error"] = [
                "message" => "No article exists!"
            ];
        }

        return response()->json($response);
    }


    public function createArticle(Request $request)
    {
        $requestAll = $request->all();

        if (isset($requestAll["title"]) && isset($requestAll["contents"])) {
            $response["status"] = "OK";
            $response["data"] = Article::create($requestAll);
        } else {
            $response["status"] = "NO";
            $response["error"] = [
                "message" => "Missing required arguments!"
            ];
        }

        return response()->json($response);
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