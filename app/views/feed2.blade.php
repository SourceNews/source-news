<!DOCTYPE html>
<html>

    <head>
        <title>Source News</title>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
        <link href="/css/general.css" rel="stylesheet" media="screen">
        <script type='text/javascript' src="/js/jquery-1.10.1.min.js"></script>
        <script type='text/javascript' src="/js/jquery.autosize.min.js"></script>
        <script type='text/javascript' src="/js/script.js"></script>
    </head>

    <body class="feed feed-2">
        
        <div class="side">
            <div class="logo"><span class="glyphicon glyphicon-globe"></span>source<span>news</span></div>
            <span class="hello">Hello, USERNAME</span>
            
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

            <div class="my-cats categories">
                <span class="title">My RSS Feeds</span>
                <ul>
                    <li><a href="">Guardian</a></li>
                </ul>
                <div class="rss">
                    <input type="text" name="rss" placeholder="URL"/>
                    <div class="comment-add"><span class="glyphicon glyphicon-plus-sign"></span>Add an RSS feed URL</div>
                </div>
            </div>

            <div class="footer">
                <a href="/logout">Logout</a>
            </div>

        </div>


        <div class="main">

            <div class="column">
                <h1>The Guardian</h1>

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