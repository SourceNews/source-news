<?php 

class FeedController extends \BaseController
{

    public function showFeed($id = null) {
    	if($id != null) {
    		$feed = Feed::find($id);
    		$arts = $feed->articles()
    			->orderBy("pub_time", 'DESC')
    			->take(11)
    			->get();
				$articles = array();
    			foreach ($arts as $a) {
    				$paragraph = $a->paragraphs()
    					->orderBy("index", 'ASC')
    					->first();
    				$articles[$a->title] = $paragraph->text;
    			}

    			$feedName = $feed->title;
                reset($articles);
                $firstArticle = key($articles);
                array_shift($articles);
    		return View::make('feed2', compact("feedName", "firstArticle", "articles"));
    	}
    	return View::make('feed');
    }
}