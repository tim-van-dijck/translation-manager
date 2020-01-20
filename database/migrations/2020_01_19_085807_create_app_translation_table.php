<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_translation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('app_id', false, true);
            $table->integer('translation_id', false, true);
            $table->timestamps();

            $table->foreign('app_id')
                ->references('id')
                ->on('apps')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('translation_id')
                ->references('id')
                ->on('translations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_translation');
    }
}
