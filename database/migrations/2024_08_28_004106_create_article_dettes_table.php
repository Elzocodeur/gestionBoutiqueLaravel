<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('article_dettes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('dette_id');
            $table->integer('qteVente');
            $table->decimal('prixVente', 10, 2);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('dette_id')->references('id')->on('dettes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_dette');
    }
};
