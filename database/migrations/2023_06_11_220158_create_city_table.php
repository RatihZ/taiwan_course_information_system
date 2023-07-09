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
        Schema::create('city', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('name_en', 36);
            $table->string('name_zh', 36);
            $table->string('country_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["country_id"], 'fk_city_country1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('country_id', 'fk_city_country1_idx')
                ->references('uuid')->on('country')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city');
    }
};
