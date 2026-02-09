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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('path'); // The storage path (e.g., 'uploads/chat/pic.jpg')
            $table->string('filename');
=======
>>>>>>> 5d7b04ebed38e54ce47d70f24a11681d003e492e
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
