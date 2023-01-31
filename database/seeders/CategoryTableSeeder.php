<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['HTML','CSS','JavaScript','VueJs','PHP','Laravel'];

        foreach($data as $item){
            $new_category = new Category();
            $new_category->name = $item;
            $new_category->slug = Str::slug($item);
            $new_category->save();
        }
    }
}
