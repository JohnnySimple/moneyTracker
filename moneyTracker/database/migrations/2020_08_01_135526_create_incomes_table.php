<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->Biginteger('income_source_id')->unsigned();
            $table->float('amount');
            $table->Biginteger('wallet_id')->unsigned();
            $table->Biginteger('user_id')->unsigned();
            $table->timestamp('time_received')->useCurrent = true;

            $table->foreign('income_source_id')->references('id')->on('income_sources');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('incomes');
    }
}
