<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_taxonomies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('term_id');
            $table->string('taxonomy');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent')->nullable();
            $table->unsignedBigInteger('count')->nullable();
            $table->foreign('term_id')->references('id')->on('terms')
                ->onDelete('cascade');
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
        Schema::dropIfExists('term_taxonomies');
    }
}
