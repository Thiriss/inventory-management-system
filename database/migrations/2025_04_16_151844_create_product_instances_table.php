<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInstancesTable extends Migration
{
    public function up(): void
    {
        Schema::create('product_instances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('rfid_tag_id')->constrained('rfids')->onDelete('cascade');

            $table->string('status')->nullable();
            $table->string('location')->nullable(); // Optional, based on your use case

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_instances');
    }
}
