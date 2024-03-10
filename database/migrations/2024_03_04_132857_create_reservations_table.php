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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->enum("status",["accepted","rejected","pending"])->default("pending");
            $table->integer('numberOfTicket');
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("event_id")->nullable()->constrained("events")->onDelete("set null");
            $table->boolean("itsPaid")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
