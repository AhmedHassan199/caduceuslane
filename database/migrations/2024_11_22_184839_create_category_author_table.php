<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryAuthorTable extends Migration
{
    public function up()
    {
        Schema::create('category_author', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Assuming authors are users
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_author');
    }
}
