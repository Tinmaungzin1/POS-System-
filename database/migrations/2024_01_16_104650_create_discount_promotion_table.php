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
        Schema::create('discount_promotion', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->integer('amount')->nullable()->unsigned();
            $table->integer('percentage')->nullable()->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('discount_promotion');
    }
};