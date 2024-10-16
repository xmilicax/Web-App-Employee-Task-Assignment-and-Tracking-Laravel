<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('description');
            $table->string('workers');
            $table->string('manager');
            $table->date('deadline');
            $table->integer('priority');
            $table->unsignedBigInteger('taskGroup_id');
            $table->string('file');
            $table->string('status')->default('Nezavršen');
            $table->timestamps();

            // povezivanje tabela
            $table->foreign('taskGroup_id')
                ->references('id')
                ->on('task_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
