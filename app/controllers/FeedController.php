<?php 

class FeedController extends \BaseController
{

    public function showFeed($id = null) {
    	
    	$user = Auth::user();
    	
    	$feed = Feed::all()->first();
    	
    	if($id != null) {
    		$feed = Feed::find($id);
    		$articles = $feed->articles()
    			->orderBy("pub_time", 'DESC')
    			->take(11);
    		
    		return View::make('feed2', compact("user", "feed", "articles"));
    	}
    	return View::make('feed', compact("user", "feed"));
    }
}