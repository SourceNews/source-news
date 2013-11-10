<?php

class RssFeedController extends \BaseController {
	
	public function loadRss()
	{
		$url = Input::get('rss_url');

		// fetch the FeedReader
	    $reader = $this->container->get('debril.reader');

	    // this date is used to fetch only the latest items
	    $date = new \DateTime($unmodifiedSince);

	    // the feed you want to read
	    $url = 'http://host.tld/feed';

	    // now fetch its (fresh) content
	    $feed = $reader->getFeedContent($url, $date);
	}
}