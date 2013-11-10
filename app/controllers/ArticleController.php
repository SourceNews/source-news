<?php 

class ArticleController extends \BaseController
{

    public function showArticle($id) {
    	$art = Article::find($id);
        $title = $art->title;
        $paragraphs = Paragraph::where(
        	'article_id', '=', $id)->orderBy('index')->get();
        error_log($paragraphs);

        return View::make('article', compact("title", "paragraphs"));
    }
}