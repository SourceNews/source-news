<?php 

class FeedController extends \BaseController
{

    public function showFeed($id = null) {
    	if($id != null) {
    		$feed = Feed::find($id);
    		$articles = $feed->articles()
    			->orderBy("pub_time", 'DESC')
    			->take(11);
    		
    		return View::make('feed2', compact("feed", "articles"));
    	}
    	return View::make('feed');
    }
}