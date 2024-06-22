<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;



return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('pending', 'driving', 'accepted', 'canceled', 'completed') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('pending','driving', 'accepted', 'canceled', 'completed') DEFAULT 'pending'");
    }
};


//composer require doctrine/dbal:^3.0
