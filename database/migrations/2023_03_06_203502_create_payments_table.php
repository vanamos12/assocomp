<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->float('amount');
            $table->foreignId('meeting_id')->constrained('meetings');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('rubrique_id')->constrained('rubriques');
            $table->string('status');
            $table->date('creation');
            $table->date('nextpaymentlimit');
            $table->float('total');
            $table->float('partrembtotal')->default(0);
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
        Schema::dropIfExists('payments');
    }
}
