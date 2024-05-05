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
        Schema::create('audit_block_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('audit_block_id');
            $table->boolean('is_answer_required')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->foreign('audit_block_id')->references('id')->on('audit_blocks');
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
        Schema::dropIfExists('audit_block_questions');
    }
};
