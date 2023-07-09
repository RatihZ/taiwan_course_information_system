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
        Schema::create('department_detail', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('university_id', 36);
            $table->string('faculty_id', 36);
            $table->string('department_id', 36);
            $table->string('language_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["university_id"], 'fk_department_detail_university1_idx');

            $table->index(["faculty_id"], 'fk_department_detail_faculty1_idx');

            $table->index(["department_id"], 'fk_department_detail_department1_idx');

            $table->index(["language_id"], 'fk_department_detail_language1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('university_id', 'fk_department_detail_university1_idx')
            ->references('uuid')->on('university')
            ->onDelete('no action')
            ->onUpdate('no action');

        $table->foreign('faculty_id', 'fk_department_detail_faculty1_idx')
            ->references('uuid')->on('faculty')
            ->onDelete('no action')
            ->onUpdate('no action');

        $table->foreign('department_id', 'fk_department_detail_department1_idx')
            ->references('uuid')->on('department')
            ->onDelete('no action')
            ->onUpdate('no action');

        $table->foreign('language_id', 'fk_department_detail_language1_idx')
            ->references('uuid')->on('language')
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
        Schema::dropIfExists('department_detail');
    }
};
