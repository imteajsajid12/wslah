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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('theme_style', 20)->default('default')->after('theme'); // 'default' or 'new'
            $table->string('layout_type', 20)->default('horizontal')->after('theme_style'); // 'horizontal' or 'vertical'
            $table->text('custom_background')->nullable()->after('layout_type'); // For custom background settings
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['theme_style', 'layout_type', 'custom_background']);
        });
    }
};
