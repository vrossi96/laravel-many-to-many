<?php

use Illuminate\Database\Seeder;
use App\User;

use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@a';
        $user->password = bcrypt('admin');

        $user->save();

        for ($i = 0; $i < 4; $i++) {
            $auto_user = new User();
            $auto_user->name = $faker->word();
            $auto_user->email = $faker->email();
            $auto_user->password = bcrypt('admin');

            $auto_user->save();
        }
    }
}
