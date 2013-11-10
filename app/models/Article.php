<?php

class Article extends Eloquent {
// 	Schema::create('articles', function(Blueprint $table){
// 			$table->increments('id');
// 			$table->string('title');
// 			$table->time('pub_time');
// 			$table->string('url')->unique();
// 			$table->string('subject')->nullable()->nullable();
// 			$table->integer('author_id')->unsigned()->nullable();
// 			$table->integer('thumb_id')->unsigned()->nullable();
// 			$table->integer('image_id')->unsigned();
// 			$table->timestamps();
			
// 			$table->foreign('image_id')
// 			->references('id')
// 			->on('images');

// 			$table->foreign('thumb_id')
// 			->references('id')
// 			->on('images');
				
// 			$table->foreign('author_id')
// 					->references('id')
// 					->on('authors')
// 					->onDelete('set null')
// 					->onUpdate('cascade');
// 		});
}