<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueIndexInModulesParecerAluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modules.parecer_aluno', function (Blueprint $table) {
            $table->unique('matricula_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modules.parecer_aluno', function (Blueprint $table) {
            $table->dropUnique('matricula_id');
        });
    }
}
