<?php

use App\Models\Loan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->float('amount');
            $table->date('creation');
            $table->foreignId('meeting_id')->constrained('meetings');
            $table->string('loaned')->default(Loan::NOT_LOANED);
            $table->text('textloaned')->default('');
            // Le montant restant a louer lorsque le pret est partiellement loue.
            $table->float('partloanamount')->default(0);
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
        Schema::dropIfExists('loans');
    }
}
