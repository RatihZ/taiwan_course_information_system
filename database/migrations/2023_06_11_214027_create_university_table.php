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
        Schema::create('university', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('name_zh', 36);
            $table->string('name_en', 36);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('fax', 20);

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
        Schema::dropIfExists('university');
    }
};
