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
        Schema::create('paper', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('title_en', 36);
            $table->string('title_zh', 36);
            $table->text('description_en');
            $table->text('description_zh');
            $table->string('link', 20);

            $table->unique(["uuid"], 'uuid_UNIQUE');
            $table->softDeletes();
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
        Schema::dropIfExists('paper');
    }
};
