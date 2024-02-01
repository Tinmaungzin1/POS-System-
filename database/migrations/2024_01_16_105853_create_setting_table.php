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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 200);
            $table->string('company_phone', 200);
            $table->string('company_email', 200);
            $table->mediumText('company_address');
            $table->string('company_logo', 200)->nullable();
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
        Schema::dropIfExists('setting');
    }
};