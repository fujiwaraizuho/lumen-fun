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
            $response["success"] = true;
            $response["code"] = 200;
            $response["count"] = $count;
            $response["data"] = $article;
        } else {
            $response["success"] = false;
            $response["code"] = 404;
            $response["message"] = "No article exists!";
        }

        return response()->json($response, $response["code"]);
    }


    public function getArticleById(Int $id)
    {
        $article = Article::find($id);

        if (!is_null($article)) {
            $response["success"] = true;
            $response["code"] = 200;
            $response["data"] = $article;
        } else {
            $response["success"] = false;
            $response["code"] = 404;
            $response["message"] = "No article exists!";
        }

        return response()->json($response, $response["code"]);
    }


    public function createArticle(Request $request)
    {
        $requestAll = $request->all();

        if (isset($requestAll["title"]) && isset($requestAll["contents"])) {
            $response["success"] = true;
            $response["code"] = 201;
            $response["data"] = Article::create($requestAll);
        } else {
            $response["success"] = false;
            $response["code"] = 400;
            $response["message"] = "Missing required arguments!";
        }

        return response()->json($response, $response["code"]);
    }


    public function updateArticle(Request $request, Int $id)
    {
        $article = Article::find($id);
        $title = $request->input("title");
        $contents = $request->input("contents");

        if (!is_null($article)) {
            if ($title && $contents) {
                $article->title = $title;
                $article->contents = $contents;
                $article->save();

                $response["success"] = true;
                $response["code"] = 201;
                $response["data"] = $article;
            } else {
                if ($title || $contents) {
                    if ($title) {
                        $article->title = $title;
                    } else if ($contents) {
                        $article->contents = $contents;
                    }
                    $article->save();
    
                    $response["success"] = true;
                    $response["code"] = 201;
                    $response["data"] = $article;   
                }
            }

            if (!$title && !$contents) {
                $response["success"] = false;
                $response["code"] = 400;
                $response["message"] = "No arguments!"; 
            }
        } else {
            $response["success"] = false;
            $response["code"] = 404;
            $response["message"] = "No article exists!";
        }

        return response()->json($response, $response["code"]);
    }


    public function deleteArticle(Int $id)
    {
        $article = Article::find($id);
        
        if (!is_null($article)) {
            $article->delete();

            $response["success"] = true;
            $response["code"] = 200;
            $response["data"] = $article;
        } else {
            $response["success"] = false;
            $response["code"] = 404;
            $response["message"] = "No article exists!";
        }

        return response()->json($response, $response["code"]);
    }
}