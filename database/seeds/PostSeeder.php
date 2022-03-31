<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

use App\User;
use App\Models\Post;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Recupero gli id delle categories
        $category_ids = Category::pluck('id')->toArray();
        // Recupero gli id degli utenti
        $user_ids = User::pluck('id')->toArray();
        // Recupero gli id degli tags
        $tags_ids = User::pluck('id')->toArray();

        for ($i = 0; $i < 25; $i++) {
            $post = new Post();
            $post->title = $faker->sentence(3);
            $post->content = $faker->paragraph();
            $post->img = $faker->imageUrl(640, 480, 'animals', true);
            $post->slug = Str::slug($post->title, '-');
            // ID CATEGORIES
            $post->category_id = Arr::random($category_ids);
            // ID USERS
            $post->user_id = Arr::random($user_ids);
            $post->save();

            // FOR MANY TO MANY
            $post->tags()->attach(Arr::random($tags_ids, Arr::random([1, 2, 3])));
        }
    }
}
