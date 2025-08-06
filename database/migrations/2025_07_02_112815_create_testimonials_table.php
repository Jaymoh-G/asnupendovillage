<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('body');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->timestamps();

            $table->foreign('program_id')
                  ->references('id')
                  ->on('programs')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
