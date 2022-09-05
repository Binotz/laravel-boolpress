<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for($i = 0; $i < 15; $i++){
            $new_post = new Post();

            $new_post->title = $faker->words(rand(1,10), true);
            $new_post->slug = strtolower(Str::slug( $new_post->title, '-'));
            $new_post->content = $faker->paragraph();

            $new_post->save();
        }
    }
}
