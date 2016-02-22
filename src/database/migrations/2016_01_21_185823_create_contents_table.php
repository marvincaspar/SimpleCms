<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContentsTable
 */
class CreateContentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            // These columns are needed for Baum's Nested Set implementation to work.
            // Column names may be changed, but they *must* all exist and be modified
            // in the model.
            // Take a look at the model scaffold comments for details.
            // We add indexes on parent_id, lft, rgt columns by default.
            $table->increments('id');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();

            // Add needed columns here (f.ex: name, slug, path, etc.)
            $table->string('title');
            $table->string('nav_title');
            $table->string('slug')->unique()->index();
            $table->string('banner');
            $table->text('body');
            $table->integer('order')->unsigned()->default(1);
            $table->text('css')->nullable();
            $table->text('js')->nullable();
            $table->boolean('show_title')->default(true);

            // SEO
            $table->text('teaser')->nullable();
            $table->text('keywords')->nullable();

            // site, nav_only, link
            $table->string('type')->default('site');
            $table->integer('link_to_content_id')->nullable();
            $table->integer('user_id')->unsigned();

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
        Schema::drop('contents');
    }

}
