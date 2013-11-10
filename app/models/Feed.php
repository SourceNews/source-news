<?php

use Debril\RssAtomBundle\Protocol\FeedIn;
use Debril\RssAtomBundle\Protocol\ItemIn;
use Debril\RssAtomBundle\Protocol\Parser\Item;
class Feed extends Eloquent implements FeedIn {
	
		private $tempArticles = array();
	
		public function articles()
		{
			return $this->hasMany('Article');
		}
	
		public function addItem(ItemIn $item){
			return $this->addArticle($item);
		}
		
		public function addArticle(Item $item){
			
			$article = new Article();
			$article->title = $item->getTitle();
			$article->description = $item->getDescription();
			$article->pub_time = $item->getUpdated();
			$article->url = $item->getLink();

			$this->tempArticles[] = $article;			
		}
		
		public function save(array $options = array()){
			
			if(parent::save($options)){
				foreach($this->tempArticles as $article)
					$this->articles()->save($article);
				
				return true;
			}
			
		}
		
    	public function setLastModified(\DateTime $lastModified){
    		$this->last_checked = $lastModified;
    	}
    	
    	public function setTitle($title){
    		$this->title = $title;
    	}
    	
    	public function setDescription($description){
    		$this->description = $description;
    	}
    	
    	public function setLink($link){
    		$this->link = $link;
    	}
    	
    	public function setPublicId($id){
    	}
			
		// Schema::create('feeds', function(Blueprint $table){
		// 	$table->increments('id');
		// 	$table->string('title');
		// 	$table->string('url')->unqiue();
		// 	$table->string('description')->nullable();
		// 	$table->string('language', 5)->nullable();
		// 	$table->text('copyright')->nullable();
		// 	$table->integer('image_id')->unsigned()->nullable();
		// 	$table->timestamps();
			
		// 	$table->foreign('image_id')
		// 		->references('id')
		// 		->on('images');			
		// });
}
