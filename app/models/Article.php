<?php

class Article extends Eloquent {
	
	public function feed()
	{
		return $this->belongsTo('Feed');
	}
	
	public function paragraphs()
	{
		return $this->hasMany('Paragraph');
	}
		
	public function save(array $options = array())
	{
		if(parent::save($options))	{
			$paragraphs = $this->splitContent($this->description);
			$index = 0;
			foreach($paragraphs as $text){
				$paragraph = new Paragraph();
				$paragraph->index = $index;
				$paragraph->text = $text;
				$paragraph->article_id = $this->id;
				
				$index++;
				
				$this->paragraphs()->save($paragraph);			
			}
		}
	}
	
	protected function splitContent($html){
		$html = html_entity_decode($html);
		$html = preg_replace("#</p>#", "\n", $html);
		$html = preg_replace("#<div class=\"related\".*#", "", $html);
		$html = preg_replace("#</?\w+\s*[^>]*?>#", "", $html);
		$html = preg_split("#\n#", $html, 0, PREG_SPLIT_NO_EMPTY);
		return $html;
	}
	
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