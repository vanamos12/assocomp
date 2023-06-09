<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique()->default('');
            $table->string('slug');
            $table->integer('fonction')->default(6);
            $table->float('balanceCotisation')->default(0);
            $table->float('balanceEpargne')->default(0);
            $table->float('balanceFondsRoulement')->default(0);
            $table->text('bio')->default('');
            $table->string('email')->unique();
            $table->boolean('canconnect')->default(false);
            $table->smallInteger('type')->default('1');
            $table->foreignId('company_id')->constrained('companies');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
}
