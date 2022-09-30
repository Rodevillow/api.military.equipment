<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new Item();
        $item->title = Str::random(10);
        $item->description = Str::random(120);
        $item->user_id = "59fcf90d-3849-4934-bce5-c3f4644c926f";
        $item->category_id = "5ee5691d-f4dc-4ca0-a628-591e6b2cda4e";
        $item->type_id = "f8d33001-1824-477d-9264-1d88b019f9c1";
        $item->photo_id = "images/Pushka.png";
        $item->save();
    }
}
