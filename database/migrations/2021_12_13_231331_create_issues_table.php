<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('os')->nullable();
            $table->text('os_distribution')->nullable();
            $table->text('version')->nullable();
            $table->text('steps_to_reproduce')->nullable();
            $table->text('extra_infos')->nullable();
            $table->text('user_discord_id')->nullable();
            $table->text('github_link')->nullable();
            $table->text('trello_ref')->nullable();
            $table->uuid('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->uuid('type_id');
            $table->foreign('type_id')->references('id')->on('types');

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
        Schema::dropIfExists('issues');
    }
}
