<?php

use App\Models\CategoryModel;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail');
            $table->string('author');
            $table->string('publisher');
            $table->date('Publication');
            $table->double('Price');
            $table->integer('Quantity');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
