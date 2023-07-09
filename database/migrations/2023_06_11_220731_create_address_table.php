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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->text('address_en');
            $table->text('address_zh')->nullable();
            $table->string('university_id', 36);
            $table->string('city_id', 36);
            $table->string('country_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["university_id"], 'fk_address_university1_idx');

            $table->index(["city_id"], 'fk_address_city1_idx');

            $table->index(["country_id"], 'fk_address_country1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('university_id', 'fk_address_university1_idx')
            ->references('uuid')->on('university')
            ->onDelete('no action')
            ->onUpdate('no action');

        $table->foreign('city_id', 'fk_address_city1_idx')
            ->references('uuid')->on('city')
            ->onDelete('no action')
            ->onUpdate('no action');

        $table->foreign('country_id', 'fk_address_country1_idx')
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
        Schema::dropIfExists('address');
    }
};
