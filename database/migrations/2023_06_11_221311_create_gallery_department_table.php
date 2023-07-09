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
        Schema::create('gallery_department', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('title_en', 36);
            $table->string('title_zh', 36);
            $table->text('image_path');
            $table->string('department_detail_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["department_detail_id"], 'fk_gallery_department_detail1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('department_detail_id', 'fk_gallery_department_detail1_idx')
            ->references('uuid')->on('department_detail')
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
        Schema::dropIfExists('gallery_department');
    }
};
