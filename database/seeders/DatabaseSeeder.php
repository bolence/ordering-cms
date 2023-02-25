<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Status;
use App\Models\OrderItem;
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
        // User::truncate();
        // User::factory()->create();
        Status::factory(5)->create();
        // Order::factory(10)->create();
        // OrderItem::factory(50)->create();
        Schema::enableForeignKeyConstraints();
    }
}
