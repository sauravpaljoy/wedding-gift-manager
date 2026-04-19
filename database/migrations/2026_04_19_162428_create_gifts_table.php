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
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // দ্রুত রিপোর্ট পাওয়ার জন্য
            $table->enum('type', ['cash', 'item']);
            $table->decimal('amount', 12, 2)->nullable(); // যদি নগদ টাকা হয়
            $table->string('item_name')->nullable(); // যদি গিফট আইটেম হয় (e.g. ওভেন)
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gifts');
    }
};
