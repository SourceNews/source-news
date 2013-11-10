<?php

use \Debril\RssAtomBundle\Protocol\FeedReader;
use \Debril\RssAtomBundle\Protocol\Parser\Factory;
use \Debril\RssAtomBundle\Protocol\Parser\RssParser;
use \Debril\RssAtomBundle\Driver\HttpCurlDriver;

class RssFeedController extends \BaseController {

	protected $driver;
	
	public function loadRss(){
		$url = Input::get('rss_url', 'http://feeds.theguardian.com/theguardian/uk-news/rss');
		
		if(!is_object($feed = Feed::where('url', '=', $url)->first())){
			$feed = new Feed();
			$feed->url = $url;
		}
		
		$last_modified = isset($feed->last_checked)? new DateTime(date("Y-m-d")) : new DateTime(date("Y-m-d", time()-604800));
		
		$reader = new FeedReader(new HttpCurlDriver(), new Factory());
		$reader->addParser(new RssParser());
	    
	    // now fetch its (fresh) content
	    $feedContent = $reader->readFeed($url, $feed, $last_modified);
	    if($feed->save()){
			
	    } 	    	    
	    
	  //	$articles = $feedContent->getItems();
	}

	function storeFeed($feed){

	}
}
