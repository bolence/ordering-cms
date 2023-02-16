<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('type');
            $table->string('tshirt_color')->nullable();
            $table->string('tshirt_type')->nullable(); //muska,zenska
            $table->string('tshirt_size')->nullable();
            $table->smallInteger('badge_size')->nullable();
            $table->json('tip_kacenja')->nullable();
            $table->enum('plastifikacija', ['sjaj', 'mat']);
            $table->smallInteger('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
