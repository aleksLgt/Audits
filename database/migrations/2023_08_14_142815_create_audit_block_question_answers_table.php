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
        Schema::create('audit_block_question_answers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('audit_block_question_id');
            $table->foreign('audit_block_question_id')->references('id')->on('audit_block_questions');
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
        Schema::dropIfExists('audit_block_question_answers');
    }
};
