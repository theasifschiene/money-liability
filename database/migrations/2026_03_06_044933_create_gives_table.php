<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gives', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('person');

            $table->text('reason')->nullable();

            $table->date('date');

            $table->date('tolded_date')->nullable();

            $table->date('expected_give_date');

            $table->decimal('amount',10,2);

            $table->boolean('status')->default(false);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gives');
    }
};