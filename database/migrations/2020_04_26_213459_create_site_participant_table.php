<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_participant', function (Blueprint $table) {
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('site_id');
            $table->unsignedBigInteger('package_id')->nullable();

            $table->foreign('participant_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onDelete('cascade');
            $table->foreign('package_id')
                ->references('id')
                ->on('packages')
                ->onDelete('cascade');

            $table->index(['participant_id', 'site_id', 'package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_participant');
    }
}
