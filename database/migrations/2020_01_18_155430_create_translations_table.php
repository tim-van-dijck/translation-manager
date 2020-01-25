<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('key_id', false, true);
            $table->string('language', 2);
            $table->text('translation');
            $table->timestamps();

            $table->foreign('key_id')
                ->references('id')
                ->on('translation_keys')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->index('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
