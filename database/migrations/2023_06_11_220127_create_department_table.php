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
        Schema::create('department', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('name_en', 36);
            $table->string('name_zh', 36);
            $table->string('faculty_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["faculty_id"], 'fk_department_faculty1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('faculty_id', 'fk_department_faculty1_idx')
            ->references('uuid')->on('faculty')
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
        Schema::dropIfExists('department');
    }
};
