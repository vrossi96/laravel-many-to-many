<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Category();
            $post->name = $faker->word();
            $post->color = $faker->hexColor();
            $post->save();
        }
    }
}
