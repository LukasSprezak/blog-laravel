<?php
declare(strict_types=1);

use Illuminate\{Support\Facades\Schema, Database\Schema\Blueprint, Database\Migrations\Migration};

class CreateArticlesTable extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->integer('category_id')->unsigned();
            $table->string('title', 255)->unique();
            $table->string('slug');
            $table->text('content')->nullable($value = true);
            $table->boolean('enabled')->default(0);
         //   $table->enum('status', ['publish', 'unpublished', 'draft'])->default('draft');
            $table->string('imageName')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('articles');
        Schema::enableForeignKeyConstraints();
    }
}
