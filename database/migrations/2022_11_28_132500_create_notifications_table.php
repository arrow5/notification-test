<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('inspection_period');
            $table->integer('count_page')->default(1);
            $table->boolean('idealita_active')->default(0);
            $table->string('idealista_url')->nullable();
            $table->boolean('olx_active')->default(0);
            $table->string('olx_url')->nullable();
            $table->boolean('fb_active')->default(0);
            $table->string('fb_url')->nullable();
            $table->foreignId('notification_type_id')->constrained();
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
        Schema::dropIfExists('notifications');
    }
}
