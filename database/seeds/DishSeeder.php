<?php

use Illuminate\Database\Seeder;
use App\Models\Dish;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) { 
            $dish = new Dish();
            $dish->name = $faker->sentence(4);
            $dish->slug = Str::slug($dish->name);
            $dish->ingredients = $faker->sentence(7);
            $dish->description = $faker->paragraph(4,true);
            $dish->price = $faker->randomFloat(2,5,30);
            $dish->visibility = $faker->boolean(70);
            $dish->save();
        }
    }
}
