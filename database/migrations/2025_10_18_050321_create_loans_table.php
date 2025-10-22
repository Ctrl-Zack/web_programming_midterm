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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->date('loan_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('return_date')->nullable();
            $table->decimal('fine', 10, 2)->default(0);
            $table->enum('status', ['borrowed', 'returned', 'late'])->default('borrowed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        // drop table(s)
        Schema::dropIfExists('loans');
        Schema::enableForeignKeyConstraints();
    }
};
