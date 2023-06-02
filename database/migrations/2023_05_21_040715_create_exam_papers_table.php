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
        Schema::create('exam_papers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('subject_id')->index()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->text('description')->nullable();
            $table->timestamp('date_and_time')->nullable();
            $table->unsignedInteger('duration')->comment('minuites');
            $table->unsignedFloat('total_mark', 10, 0);
            $table->unsignedFloat('per_question_mark', 10, 0);
            $table->unsignedFloat('per_question_negative_mark', 10, 0)->nullable();
            $table->text('exam_entry_description')->nullable();
            $table->timestamp('result_publish_time')->nullable();
            $table->string('status')->default('active')->comment('active, inactive');
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
        Schema::dropIfExists('exam_papers');
    }
};
