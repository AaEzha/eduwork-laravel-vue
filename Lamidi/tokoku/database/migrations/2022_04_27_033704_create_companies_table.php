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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('TOKOKU POS');
            $table->string('company_address')->default('TOKOKU POS Jatim');
            $table->string('company_phone')->default('+62 82248969890');
            $table->string('company_email')->default('TOKOKUPOS@mail.com');
            $table->string('company_fax')->default('+62 82248969890');
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
        Schema::dropIfExists('companies');
    }
};
