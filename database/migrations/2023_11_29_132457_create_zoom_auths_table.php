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
        Schema::create('zoom_auths', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->nullable(false)->comment('account_id - rest api');
            $table->string('client_id')->nullable(false)->comment('client id - rest api');
            $table->string('client_secret')->nullable(false)->comment('client secret - rest api');
            $table->string('secret_token')->nullable(false)->comment('secret token - webhook');
            $table->longText('access_token')->nullable(true)->comment('access token - rest api');
            $table->longText('refresh_token')->nullable(true)->comment('refresh_token - rest api');
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
        Schema::dropIfExists('zoom_auths');
    }
};
