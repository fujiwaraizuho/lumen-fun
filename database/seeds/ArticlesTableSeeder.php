<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            0 => [
                "title" => "title0",
                "contents" => "contents0"
            ],
            1 => [
                "title" => "title1",
                "contents" => "contents1"
            ],
            2 => [
                "title" => "title2",
                "contents" => "contents2"
            ]
        ];

        $i = 0;

        while (true) {
            DB::table("articles")->insert([
                "title" => $data[$i]["title"],
                "contents" => $data[$i]["contents"]
            ]);

            $i++;

            if ($i === 3) break;
        }
    }
}
