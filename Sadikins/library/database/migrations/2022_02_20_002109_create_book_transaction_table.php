<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id');
            $table->foreignId('transaction_id');
            // $table->primary(['book_id', 'transaction_id']);

            $table->foreign('book_id')->references('id')
                ->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('transaction_id')->references('id')
                ->on('transactions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_transaction');
    }
};
