<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Category::class)->create([
            'name' => 'Mountain bikes',
        ]);

        factory(Category::class)->create([
            'name' => 'Road bikes',
        ]);

        factory(Category::class)->create([
            'name' => 'Hybrid bikes',
        ]);

        factory(Category::class)->create([
            'name' => 'Electric bikes',
        ]);
    }
}
