<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('item')->unsigned();
            $table->foreignId('discount_promotion_id')->constrained('discount_promotion')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_item');
    }
};
