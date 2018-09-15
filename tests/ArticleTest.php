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
        $this->get("/api/".env("VERSION")."/article")
            ->seeJson([
                "status" => "OK",
                "count" => 3
            ]);
    }


    public function testIndexNoArticle()
    {
        Artisan::call("migrate:refresh");
        $this->get("/api/".env("VERSION")."/article")
            ->seeJson([
                "status" => "NO",
            ]);
        (new \DatabaseSeeder())->run();
    }


    public function testGetArticleById()
    {
        $this->get("/api/".env("VERSION")."/article/1")
            ->seeJson([
                "status" => "OK"
            ]);
    }


    public function testGetNoArticleExistsById()
    {
        $this->get("/api/".env("VERSION")."/article/4")
            ->seeJson([
                "status" => "NO"
            ]);
    }


    public function testCreateArticle()
    {
        $param = [
            "title" => "title3",
            "contents" => "contents3"
        ];

        $this->post("/api/".env("VERSION")."/article", $param)
            ->seeJson([
                "status" => "OK",
            ]);

        $this->get("/api/".env("VERSION")."/article/4")
            ->seeJson([
                "status" => "OK"
            ]);
    }


    public function testUpdateArticle()
    {
        $this->markTestIncomplete(
            "このテストは、まだ実装されていましぇん…"
        );
    }


    public function testDeleteArticle()
    {
        $this->markTestIncomplete(
            "このテストは、まだ実装されていましぇん…"
        );
    }
}