<?php 

class ArticleController extends \BaseController
{

    public function showArticle($id) {
    	$article = Article::find($id);
        $paragraphs = $article->paragraphs()->get();

        return View::make('article', compact("paragraphs", "article"));
    }
}