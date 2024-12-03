<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
  public function run()
  {
    DB::table('categories')->insert([
      [
        'name' => 'All',
        'icon' => 'AiOutlineAppstoreAdd',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Main course',
        'icon' => 'IoRestaurantOutline',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Breakfast',
        'icon' => 'LiaMugHotSolid',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Soups',
        'icon' => 'LuSoup',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Pasta',
        'icon' => 'CiBowlNoodles',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Desserts',
        'icon' => 'LuIceCream2',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Salad',
        'icon' => 'LuSalad',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Baked',
        'icon' => 'MdOutlineBakeryDining',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Snacks',
        'icon' => 'LuPopcorn',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Appetizers',
        'icon' => 'BiBowlRice',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Seafood',
        'icon' => 'IoFishOutline',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}

