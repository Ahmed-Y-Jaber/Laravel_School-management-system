<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('amount',8,2);

            // foreign keys
            $table->foreignId('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreignId('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade');
            // الخطوات السابقة مثل هذه السطرين التاليين
            // ولكن بدل كتابة سطرين تم كتابة سطر واحد بفارق
            // foreignId
            // $table->unsignedBigInteger('teacher_id');
            // $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->string('description')->nullable();
            $table->string('year');
            $table->integer('Fee_type');
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
        Schema::dropIfExists('fees');
    }
}
