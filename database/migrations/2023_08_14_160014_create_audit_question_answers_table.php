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
    public function up(): void
    {
        Schema::create('audit_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audit_id');
            $table->foreign('audit_id')->references('id')->on('audits');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('audit_block_questions');
            $table->unsignedBigInteger('answer_id');
            $table->foreign('answer_id')->references('id')->on('audit_block_question_answers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_question_answers');
    }
};
