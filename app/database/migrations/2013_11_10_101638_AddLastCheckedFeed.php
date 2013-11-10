<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLastCheckedFeed extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('feeds', function(Blueprint $table){
			$table->timestamp('last_checked')->after('image_id');
			$table->string('link');
			$table->unique('url');
			
		});
		
		Schema::table('paragrahs', function(Blueprint $table){
			$table->rename('paragraphs');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('feeds', function(Blueprint $table){
			$table->dropColumn('last_checked');
			$table->dropColumn('link');
		});
	}

}