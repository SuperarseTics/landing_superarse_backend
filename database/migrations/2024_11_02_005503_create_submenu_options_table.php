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
        Schema::create('submenu_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submenus_id')->constrained('submenus');
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submenu_options', function (Blueprint $table) {
            $table->dropForeign('submenu_options_submenus_id_foreign');
        });
        Schema::dropIfExists('submenu_options');
    }
};
