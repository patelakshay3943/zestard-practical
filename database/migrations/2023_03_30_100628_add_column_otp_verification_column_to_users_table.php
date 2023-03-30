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
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('otp_verified_at')->after('password')->nullable();
            $table->string('otp',10)->after('password')->nullable();
            $table->boolean('is_admin')->after('password')->default(0);
            $table->bigInteger('phone_number')->after('password')->nullable();
            $table->string('member_id')->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['otp_verified_at','otp','is_admin','phone_number','member_id']);
        });
    }
};
