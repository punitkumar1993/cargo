<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('space_id')->nullable();
            $table->foreign('space_id')
                ->references('id')
                ->on('adspaces')
                ->onDelete('set null');
            $table->text('label');
            $table->string('url')->nullable();
            $table->text('image');
            $table->string('size');
            $table->enum('active', ['y', 'n'])->default('y');
            $table->text('script')->nullable();
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
        Schema::dropIfExists('advertisements');
    }
}
