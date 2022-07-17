<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('institution');
            $table->string('faculty')->nullable();
            $table->enum('degree', ['Basic','Secondary','Vocational','Bachelor', 'Master', 'PhD'])->default('Basic');
            $table->string('speciality')->nullable();
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('country')->nullable();
            $table->boolean('is_finished')->default(true);
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('order')->default(0);
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
        Schema::dropIfExists('education');
    }
}
