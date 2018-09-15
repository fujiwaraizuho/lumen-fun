<?php

namespace App\Http\Controllers;

use App\Http\Models\Article;
use Illuminate\Http\Request;

use Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        if (($count = count($articles)) > 0) {
            $response = $this->returnResponse(true, 200, [$articles]);
            $this->array_insert($response, ["count" => $count], 2);
        } else {
            $response = $this->returnResponse(false, 404, [
                "No Article Exists!"
            ]);
        }

        return response()->json($response, $response["code"]);
    }


    public function getArticleById(Int $id)
    {
        if (!is_null(($article = Article::find($id)))) {
            $response = $this->returnResponse(true, 200, [$article]);
        } else {
            $response = $this->returnResponse(false, 404, [
                "No Article Exists!"
            ]);
        }

        return response()->json($response, $response["code"]);
    }


    public function createArticle(Request $request)
    {
        $requestAll = $request->all();

        $validator = Validator::make($requestAll,[
            "title" => "required|max:50",
            "contents" => "required|between:10,300"
        ]);

        if ($validator->fails()) {
            $response = $this->returnResponse(false, 400, $validator->errors());
            return response()->json($response, $response["code"]);
        }

        $response = $this->returnResponse(true, 201, Article::create($requestAll));

        return response()->json($response, $response["code"]);
    }


    public function updateArticle(Request $request, Int $id)
    {
        if (is_null(($article = Article::find($id)))) {
            $response = $this->returnResponse(false, 404, ["No Article Exists!"]);
            return response()->json($response, $response["code"]);
        } else {
            $requestAll = $request->all();
            $validator = Validator::make($requestAll,[
                "title" => "required_without:title|max:50",
                "contents" => "required_without:title|between:10,300"
            ]);

            if ($validator->fails()) {
                $response = $this->returnResponse(false, 400, $validator->errors());
                return response()->json($response, $response["code"]);                
            }

            if ($request->input("title")) $article->title = $request->input("title");
            if ($request->input("contents")) $article->contents = $request->input("contents");

            $article->save();
            $response = $this->returnResponse(true, 201, [$article]);

            return response()->json($response, $response["code"]);
        }
    }


    public function deleteArticle(Int $id)
    {
        if (!is_null(($article = Article::find($id)))) {
            $article->delete();
            $response = $this->returnResponse(true, 200, [$article]);
        } else {
            $response = $this->returnResponse(false, 404, ["No Article Exists!"]);
        }

        return response()->json($response, $response["code"]);
    }

  
    public function returnResponse(Bool $success, Int $code, $data = [])
    {
        $response = [
            "success" => $success,
            "code" => $code
        ];
  
        $response[$success ? "data" : "message"] = $data;

        return $response;
    }

    // https://qiita.com/ka215/items/dcd2e1b0fb8c626c9e44 | @ka215 Thanks!
    public function array_insert(&$base_array, $insert_value, $position=null) {
        if (!is_array($base_array)) 
            return false;
        $position = is_null($position) ? count($base_array) : intval($position);
        $base_keys = array_keys($base_array);
        $base_values = array_values($base_array);
        if (is_array($insert_value)) {
            $insert_keys = array_keys($insert_value);
            $insert_values = array_values($insert_value);
        } else {
            $insert_keys = array(0);
            $insert_values = array($insert_value);
        }
        $insert_keys_after = array_splice($base_keys, $position);
        $insert_values_after = array_splice($base_values, $position);
        foreach ($insert_keys as $insert_keys_value) {
            array_push($base_keys, $insert_keys_value);
        }
        foreach ($insert_values as $insert_values_value) {
            array_push($base_values, $insert_values_value);
        }
        $base_keys = array_merge($base_keys, $insert_keys_after);
        $is_key_numric = true;
        foreach ($base_keys as $key_value) {
            if (!is_integer($key_value)) {
                $is_key_numric = false;
                break;
            }
        }
        $base_values = array_merge($base_values, $insert_values_after);
        if ($is_key_numric) {
            $base_array = $base_values;
        } else {
            $base_array = array_combine($base_keys, $base_values);
        }
        return true;
    }
}