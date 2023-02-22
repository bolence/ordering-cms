<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Status::truncate();
        Order::truncate();
        OrderItem::truncate();
        Status::factory(5)->create();
        Order::factory(10)->create();
        OrderItem::factory(50)->create();
        Schema::enableForeignKeyConstraints();
    }
}
