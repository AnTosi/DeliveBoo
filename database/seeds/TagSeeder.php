<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Italian', 'Breakfast', 'Vegetarian', 'Pizza', 'Indian', 'Sushi', 'Chinese', 'Japanese', 'Thai'];

        foreach ($tags as $tag) {
            $_tag = new Tag();
            $_tag->name = $tag;
            $_tag->slug = Str::slug($_tag->name);
            $_tag->save();
        }
    }
}