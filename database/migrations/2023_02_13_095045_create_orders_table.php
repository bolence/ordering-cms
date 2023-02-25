<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('delivery_type'); // ['lično', 'dostava']
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->text('napomena')->nullable();
            $table->enum('order_from', ['facebook', 'instagram', 'viber', 'email']);
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('notify')->default(0);
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('customer_id')->index()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('status_id')->index();
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('orders');
    }
}
