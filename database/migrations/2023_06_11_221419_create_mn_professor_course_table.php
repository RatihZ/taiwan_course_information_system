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
        Schema::create('mn_professor_course', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('course_id', 36);
            $table->string('professor_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["course_id"], 'fk_professor_x_course_course1_idx');

            $table->index(["professor_id"], 'fk_professor_x_course_professor1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('course_id', 'fk_professor_x_course_course1_idx')
            ->references('uuid')->on('course')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->foreign('professor_id', 'fk_professor_x_course_professor1_idx')
            ->references('uuid')->on('professor')
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
        Schema::dropIfExists('mn_professor_course');
    }
};
