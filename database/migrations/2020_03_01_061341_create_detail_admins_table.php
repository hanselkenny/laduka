<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('AdminID');
            $table->string('NamaLengkap',50);
            $table->string('NomorKaryawan',16);
            $table->string('NoTelp',13);        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_admins');
    }
}
