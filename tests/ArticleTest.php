<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
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
        $this->markTestIncomplete(
            "このテストは、まだ実装されていましぇん…"
        );
    }


    public function testGetArticleById()
    {
        $this->markTestIncomplete(
            "このテストは、まだ実装されていましぇん…"
        );
    }


    public function testCreateArticle()
    {
        $this->markTestIncomplete(
            "このテストは、まだ実装されていましぇん…"
        );
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