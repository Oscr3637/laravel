<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table){
            //añade  aqui tu nueva columna
            $table->string ('item',20)->nullable()->after ('image');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table ('posts', function (Blueprint $table){
            $table->dropcolumn('item');
        //
        });
    }
};