<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DatabaseSchema extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table){
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('username', 30)->unique();
			$table->string('password');
			$table->boolean('confirmed')->default(0);
			$table->timestamps();
		});
		
		Schema::create('images', function(Blueprint $table){
			$table->increments('id');
			$table->string('url')->unique();
			$table->integer('width')->unsigned();
			$table->integer('height')->unsigned();
			$table->string('credit')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
		});
		
		Schema::create('feeds', function(Blueprint $table){
			$table->increments('id');
			$table->string('title');
			$table->string('url')->unqiue();
			$table->string('link');			
			$table->string('description')->nullable();
			$table->string('language', 5)->nullable();
			$table->text('copyright')->nullable();
			$table->integer('image_id')->unsigned()->nullable();
			$table->timestamp('last_checked');				
			$table->timestamps();
			
			$table->unique('url');
			
			$table->foreign('image_id')
				->references('id')
				->on('images');			
		});
		
		Schema::create('authors', function (Blueprint $table){
				$table->increments('id');
				$table->string('name')->unique();
				$table->timestamps();
			});
		
		Schema::create('articles', function(Blueprint $table){
			$table->increments('id');
			$table->integer('feed_id')->unsigned();		
			$table->string('title');
			$table->text('description');
			$table->timestamp('pub_time');
			$table->string('url')->unique();
			$table->string('subject')->nullable()->nullable();
			$table->integer('author_id')->unsigned()->nullable();
			$table->integer('thumb_id')->unsigned()->nullable();
			$table->integer('image_id')->unsigned()->nullable();
			$table->timestamps();
			
			$table->foreign('feed_id')->references('id')->on('feeds')
				->onDelete('cascade')
				->onUpdate('cascade');
			
			$table->foreign('image_id')
			->references('id')
			->on('images');

			$table->foreign('thumb_id')
			->references('id')
			->on('images');
				
			$table->foreign('author_id')
					->references('id')
					->on('authors')
					->onDelete('set null')
					->onUpdate('cascade');
		});
		
		
		
		Schema::create('paragraphs', function(Blueprint $table){
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->text('text');
			$table->integer('index');
			$table->timestamps();
			
			$table->unique(array('article_id', 'index'));
			
			$table->foreign('article_id')
					->references('id')
					->on('articles')
					->onDelete('cascade')
					->onUpdate('cascade');
						
		});
		
				
		Schema::create('paragraph_sections', function(Blueprint $table){
			$table->increments('id');
			$table->integer('paragraph_id')->unsigned();
			$table->integer('start_char');
			$table->integer('last_char');
			$table->timestamps();
			
			$table->foreign('paragraph_id')
					->references('id')
					->on('paragraphs')
					->onDelete('cascade')
					->onUpdate('cascade');
		});
		
			Schema::create('comments', function (Blueprint $table){
				$table->increments('id');
				$table->text('text')->nullable();
				$table->integer('user_id')->unsigned();
				$table->boolean('agree')->nullable();
			
				$table->timestamps();
					
				$table->foreign('user_id')
				->references('id')
				->on('users');
			});
			
		
		Schema::create('paragraph_section_comment', function (Blueprint $table){
			$table->increments('id');
			$table->integer('paragraph_section_id')->unsigned();
			$table->integer('comment_id')->unsigned();
			
			$table->foreign('paragraph_section_id')
					->references('id')
					->on('paragraph_sections')
					->onDelete('cascade')
					->onUpdate('cascade');
			
			$table->foreign('comment_id')
				->references('id')
				->on('comments')
				->onDelete('cascade')
				->onUpdate('cascade');
				
		});
		
		Schema::create('article_comment', function (Blueprint $table){
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->integer('comment_id')->unsigned();
			
			$table->foreign('article_id')
					->references('id')
					->on('articles')
					->onDelete('cascade')
					->onUpdate('cascade');
			
			$table->foreign('comment_id')
				->references('id')
				->on('comments')
				->onDelete('cascade')
				->onUpdate('cascade');
				
		});		
				
		
		Schema::create('references', function(Blueprint $table){
			$table->increments('id');
			$table->string('url');
			$table->integer('comment_id')->unsigned();
			$table->integer('article_id')->unsigned();
			
			$table->foreign('comment_id')
			->references('id')
			->on('comments')
			->onDelete('cascade')
			->onUpdate('cascade');
		});
		
		Schema::create('votes', function (Blueprint $table){
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('comment_id')->unsigned();
			$table->integer('vote');
			
			$table->foreign('comment_id')
				->references('id')
				->on('comments')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->foreign('user_id')
				->references('id')
				->on('users');	
		});
	
		Schema::create('user_categories', function (Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->integer('user_id')->unsigned();
			
			$table->unique(array ('user_id', 'name'));
			
			$table->foreign('user_id')
			->references('id')
			->on('users')
			->onDelete('cascade')
			->onUpdate('cascade');
		});
			
		Schema::create('user_category_feed', function (Blueprint $table){
				
			$table->increments('id');
			$table->integer('user_category_id')->unsigned();
			$table->integer('feed_id')->unsigned();
				
			$table->foreign('user_category_id')
			->references('id')
			->on('user_categories')
			->onDelete('cascade')
			->onUpdate('cascade');
				
			$table->foreign('feed_id')
			->references('id')
			->on('feeds')
			->onDelete('cascade')
			->onUpdate('cascade');
		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_category_feed');
		Schema::drop('user_categories');
		Schema::drop('votes');
		Schema::drop('references');
		Schema::drop('article_comment');
		Schema::drop('paragraph_section_comment');
		Schema::drop('paragraph_sections');
		Schema::drop('comments');
		Schema::drop('paragraphs');
		Schema::drop('articles');
		Schema::drop('authors');
		Schema::drop('feeds');
		Schema::drop('images');
		Schema::drop('users');
	}

}