<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tag::class, 2)->create();

        factory(App\Tag::class, 3)->create()->each(function($tag) {
            $tag->users()->attach(factory(App\User::class, 2)->create());
        });
    }
}
