<!DOCTYPE html>
<html>

    <head>
        <title>Source News</title>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
        <link href="/css/general.css" rel="stylesheet" media="screen">
        <script type='text/javascript' src="/js/jquery-1.10.1.min.js"></script>
        <script type='text/javascript' src="/js/script.js"></script>
    </head>

    <body class="feed">
        
        <div class="side">
            <div class="logo">source<span>news</span></div>
          	<button><a href="/logout">Logout</a></button>
            
            <div class="categories">
                <span class="title">Categories</span>
                <ul>
                    <li><a href="">Technology</a></li>
                    <li><a href="">Politics</a></li>
                    <li><a href="">Sport</a></li>
                    <li><a href="">Science</a></li>
                    <li><a href="">Economics</a></li>
                </ul>
            </div>

        </div>

        <div class="main">

            <div class="column">
                <h1>{{ $feed->title }}</h1>

                <div class="list">
                    @foreach ($articles->get() as $index => $article)
                        <div class="story @if(!$index)top@endif" data-article_id="{{ $article->id }}">
                            <h2>{{ $article->title }}</h2>
                            <p>{{ $article->paragraphs()->first()->text }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </body>


</html>