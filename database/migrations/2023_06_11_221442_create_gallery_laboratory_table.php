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
        Schema::create('gallery_laboratory', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('title_en', 36);
            $table->string('title_zh', 36);
            $table->text('image_path');
            $table->string('laboratory_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["laboratory_id"], 'fk_gallery_laboratory_laboratory1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('laboratory_id', 'fk_gallery_laboratory_laboratory1_idx')
            ->references('uuid')->on('laboratory')
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
        Schema::dropIfExists('gallery_laboratory');
    }
};
