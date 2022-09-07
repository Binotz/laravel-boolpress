<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            'Novità',
            'Finanza',
            'Cucina',
            'Sport',
            'Vacanze',
            'Pollice Verde'
        ];

        foreach($categories as $category){
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->slug = Str::slug($category, '-');
            $new_category->save();
        }
    }
}
