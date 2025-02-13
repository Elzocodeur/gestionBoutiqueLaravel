<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->decimal('prix', 10, 2);
            $table->integer('qteStock');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
