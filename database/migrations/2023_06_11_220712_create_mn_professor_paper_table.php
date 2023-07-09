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
        Schema::create('mn_professor_paper', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->string('professor_id', 36);
            $table->string('paper_id', 36);

            $table->unique(["uuid"], 'uuid_UNIQUE');

            $table->index(["professor_id"], 'fk_professor_x_paper_professor1_idx');

            $table->index(["paper_id"], 'fk_professor_x_paper_paper1_idx');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('professor_id', 'fk_professor_x_paper_professor1_idx')
            ->references('uuid')->on('professor')
            ->onDelete('no action')
            ->onUpdate('no action');

        $table->foreign('paper_id', 'fk_professor_x_paper_paper1_idx')
            ->references('uuid')->on('paper')
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
        Schema::dropIfExists('mn_professor_paper');
    }
};
