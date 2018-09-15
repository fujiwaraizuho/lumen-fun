<?php

use Illuminate\Support\Facades\Artisan;

class ArticleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        (new \DatabaseSeeder())->run();
    }


    public function testIndex()
    {
        $this->json("GET", "/api/".env("VERSION")."/article")
            ->seeJson([
                "success" => true,
                "code" => 200,
                "count" => 3
            ]);
    }


    public function testIndexNoArticle()
    {
        Artisan::call("migrate:refresh");
        $this->json("GET", "/api/".env("VERSION")."/article")
            ->seeJson([
                "success" => false,
                "code" => 404
            ]);
        (new \DatabaseSeeder())->run();
    }


    public function testGetArticleById()
    {
        $this->json("GET", "/api/".env("VERSION")."/article/1")
            ->seeJson([
                "success" => true,
                "code" => 200
            ]);
    }


    public function testGetNoArticleExistsById()
    {
        $this->json("GET", "/api/".env("VERSION")."/article/4")
            ->seeJson([
                "success" => false,
                "code" => 404
            ]);
    }


    public function testCreateArticle()
    {
        $param = [
            "title" => "title3",
            "contents" => "contents3"
        ];

        $this->json("POST", "/api/".env("VERSION")."/article", $param)
            ->seeJson([
                "success" => true,
                "code" => 201
            ]);

        $this->json("GET", "/api/".env("VERSION")."/article/4")
            ->seeJson([
                "success" => true,
                "code" => 200
            ]);
    }


    public function testUpdateArticle()
    {
        $param = [
            "title" => "fujishan",
            "contents" => "fujishan is cool!"
        ];

        $this->json("PUT", "/api/".env("VERSION")."/article/3", $param)
            ->seeJson([
                "success" => true,
                "code" => 201,
            ]);

        $this->json("GET", "/api/".env("VERSION")."/article/3")
            ->seeJson([
                "success" => true,
                "code" => 200,
            ]);
    }


    public function testDeleteArticle()
    {
        $this->json("DELETE", "/api/".env("VERSION")."/article/3")
            ->seeJson([
                "success" => true,
                "code" => 200
            ]);
    }
}