<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('products')->insert([
                'product_name' => $faker->sentence,
                'product_details' =>$faker->paragraph,
                'product_image' => $faker->imageUrl(100,100),
                'price' => $faker->randomFloat(),
                'rating' => $faker->randomFloat(),
                'status' => $faker->boolean(),
            ]);
        }
    }
    /*   $table->string("product_name");
            $table->string("product_details");
            $table->string("product_image");

            $table->double('price');
            $table->double('rating');
            $table->boolean('status');
            $table->timestamps();*/
}
