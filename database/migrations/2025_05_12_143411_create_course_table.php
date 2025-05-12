<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('grade')->nullable(); // Có thể đổi thành integer nếu grade là số
            $table->decimal('price', 8, 2)->nullable();
            $table->timestamps();
            $table->boolean('is_deleted');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
