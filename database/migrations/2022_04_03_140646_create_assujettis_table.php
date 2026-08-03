<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssujettisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assujettis', function (Blueprint $table) {
            $table->id();
            $table->string('cnie')->unique();
            $table->string('nom');
            $table->char('sexe', 1);
            $table->string('adresse');
            $table->string('commune');
            $table->string('province');
            $table->date('convocation');
            $table->date('presentation')->nullable();
            $table->date('transport')->nullable();
            $table->string('selection');
            $table->string('centre_selection');
            $table->string('ville_selection');
            $table->string('formation')->nullable();
            $table->boolean('coupons')->nullable();
            $table->boolean('admis')->nullable();
            $table->string('trajet')->nullable();
            $table->string('vers_formation')->nullable();
            $table->string('vers_selection')->nullable();
            $table->string('vers_selection_th');
            $table->decimal('prix', 8, 2)->nullable();
            $table->string('domicile')->nullable();
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
        Schema::dropIfExists('assujettis');
    }
}
