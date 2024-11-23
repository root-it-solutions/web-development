<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasternodeListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masternode_list', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('ownerAuthAddress', 100);
            $table->string('operatorAuthAddress', 100);
            $table->unsignedBigInteger('creationHeight');
            $table->bigInteger('resignHeight');
            $table->string('state', 20);
            $table->integer('mintedBlocks');
            $table->tinyInteger('targetMultiplier1');
            $table->tinyInteger('targetMultiplier2');
            $table->tinyInteger('targetMultiplier3');
            $table->tinyInteger('targetMultiplier4');
            $table->string('timelock', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masternode_list');
    }
}
