<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->Biginteger('spending_category_id')->unsigned();
            $table->float('amount');
            $table->Biginteger('wallet_id')->unsigned();
            $table->Biginteger('user_id')->unsigned();
            $table->timestamp('time_made')->useCurrent = true;

            $table->foreign('spending_category_id')->references('id')->on('spending_categories');
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
        Schema::dropIfExists('expenses');
    }
}
