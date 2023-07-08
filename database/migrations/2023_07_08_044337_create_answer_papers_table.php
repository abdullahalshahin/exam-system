<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('answer_papers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_participant_id')->index()->nullable();
            $table->foreign('exam_participant_id')->references('id')->on('exam_participants');
            $table->unsignedBigInteger('question_id')->index()->nullable();
            $table->foreign('question_id')->references('id')->on('questions');
            $table->string('answer')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('answer_papers');
    }
};
