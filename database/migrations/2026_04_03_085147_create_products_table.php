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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('brand')->nullable();

            $table->string('image')->nullable();
            $table->json('images')->nullable();

            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();

            $table->integer('stock')->default(0);

            $table->enum('availability', ['in stock', 'out of stock'])
                ->default('in stock');

            $table->boolean('isNew')->default(false);
            $table->boolean('requiresPrescription')->default(false);





            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews')->default(0);
            $table->longText('reviewsList')->nullable();

            $table->text('description')->nullable();

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
        Schema::dropIfExists('products');
    }
};
