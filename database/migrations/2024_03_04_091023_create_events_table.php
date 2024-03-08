<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title", 50);
            $table->text("description");
            $table->integer("capacity");
            $table->integer("rest_places")->default(DB::raw("(capacity)"));
            $table->dateTime("date");
            $table->string("location", 255);
            $table->float("price");
            $table->enum("status",["accepted","rejected","pending"])->default("pending");
            $table->boolean("autoAccept")->default(false);
            $table->foreignId("organizer_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("category_id")->nullable()->constrained("categories")->onDelete("set null");
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
