<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pundit_id');
            $table->unsignedInteger('interviewer_id');
            $table->unsignedInteger('scheduled_by');
            $table->dateTime('scheduled_date_time');
            $table->string('interview_title',200);
            $table->enum('status', ['pending', 'qualified', 'rejected']);
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
        Schema::dropIfExists('schedule');
    }
}
