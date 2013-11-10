<?php

use \Debril\RssAtomBundle\Protocol\FeedReader;
use \Debril\RssAtomBundle\Protocol\Parser\Factory;
use \Debril\RssAtomBundle\Protocol\Parser\RssParser;
use \Debril\RssAtomBundle\Driver\HttpCurlDriver;

class RssFeedController extends \BaseController {

	protected $driver;

	protected $layout = 'rss';
	
	public function loadRss(){
		$url = Input::get('rss_url', 'http://feeds.theguardian.com/theguardian/uk-news/rss');
		$url = 'http://feeds.theguardian.com/theguardian/uk-news/rss';
		// fetch the FeedReader
		$reader = new FeedReader(new HttpCurlDriver(), new Factory());
		$reader->addParser(new RssParser());
	    $date = new DateTime("2013-11-08");

	    // now fetch its (fresh) content
	    $feed = $reader->getFeedContent($url, $date);

	    $this->layout->content = $feed->getItems();
	}

	function splitContent($html){
		$html = html_entity_decode($html);
		$html = preg_replace("#</p>#", "\n", $html);
		$html = preg_replace("#<div class=\"related\".*#", "", $html);
		$html = preg_replace("#</?\w+\s*[^>]*?>#", "", $html);
		$html = preg_split("#\n#", $html, 0, PREG_SPLIT_NO_EMPTY);
		return $html;
	}

	function storeFeed($feed){

	}
}
