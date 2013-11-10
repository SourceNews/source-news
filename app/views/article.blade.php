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

    <body class="article">

        <div class="tooltip">
            <div class="bubble"><span class="glyphicon glyphicon-plus-sign"></span><span class="arrow"></span></div>
        </div>
        
    	<div class="side">
            <div class="back-btn"><a href="/feed/{{ $article->feed->id }}"><span class="glyphicon glyphicon-chevron-left"></span>Back to news feed</a></div>
            <div class="source-info">
                <ul>
                    <li><span>Date</span>{{ date('l jS \of F Y h:i:s A', strtotime($article->pub_time)) }}</li>
                    <li><span>Source</span>{{ $article->feed->title }}</li>
                    <li><span>URL</span><a href="{{ $article->feed->link }}">{{ $article->feed->link }}</a></li>
                </ul>
            </div>
            <div class="stats">
                <div class="container">
                    <span class="title">Agree</span>
                    <span class="count">112</span>
                    <span class="stat-bar"><span class="bar-fill agree"></span></span>
                </div>
                <div class="container">
                    <span class="title">Disagree</span>
                    <span class="count">15</span>
                    <span class="stat-bar"><span class="bar-fill disagree"></span></span>
                </div>
                <div class="container">
                    <span class="title top-comments">Top Comments</span>
                </div>
            </div>

            <div class="comment-list">
                
                <div class="comment">
                    <div class="column">
                        <span class="image-circle"><img src="/img/henco.jpg"></span>
                        <span class="indicator red"></span>
                        <div class="vote-container">
                            <div class="direction">
                                <span class="count">98</span>
                                <span class="glyphicon glyphicon-chevron-up green"></span>
                            </div>
                            <div class="direction">
                                <span class="count">18</span>
                                <span class="glyphicon glyphicon-chevron-down red"></span>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <span class="name">Henco Appel</span>
                        <span class="desc">
                            Here is some comment
                            Here is some comment
                            Here is some comment
                            Here is some comment
                            Here is some comment
                        </span>
                    </div>
                </div>
                
                <div class="comment">
                    <div class="column">
                        <span class="image-circle"><img src="/img/samir.jpg"></span>
                        <span class="indicator red"></span>
                        <div class="vote-container">
                            <div class="direction">
                                <span class="count">74</span>
                                <span class="glyphicon glyphicon-chevron-up green"></span>
                            </div>
                            <div class="direction">
                                <span class="count">12</span>
                                <span class="glyphicon glyphicon-chevron-down red"></span>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <span class="name">Samir Moussa</span>
                        <span class="desc">
                            Here is some comment
                            Here is some comment
                            Here is some comment
                            Here is some comment
                            Here is some comment
                        </span>
                    </div>
                </div>

            </div>

            <div class="footer">
                <a href="/logout">Logout</a>
            </div>

    	</div>

    	<div class="main">

            <div id="comments-sidebar">
                <div class="comments-container">
                    <div class="comments-count">35 Comments</div>
                    <div class="comment-list">
                        <div class="comment">
                            <div class="column">
                                <span class="image-circle"><img src="/img/henco.jpg"></span>
                                <span class="indicator red"></span>
                                <div class="vote-container">
                                    <div class="direction">
                                        <span class="count">18</span>
                                        <span class="glyphicon glyphicon-chevron-up green"></span>
                                    </div>
                                    <div class="direction">
                                        <span class="count">3</span>
                                        <span class="glyphicon glyphicon-chevron-down red"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <span class="name">Henco Appel</span>
                                <span class="desc">
                                    Here is some comment
                                    Here is some comment
                                    Here is some comment
                                    Here is some comment
                                    Here is some comment
                                </span>
                            </div>
                        </div>

                        <div class="comment">
                            <div class="column">
                                <span class="image-circle"><img src="/img/samir.jpg"></span>
                            </div>
                            <div class="content">
                                <span class="name">Samir Moussa</span>
                                <div class="opinion">
                                    <span class="choice">Agree</span>
                                    <span class="separator">|</span>
                                    <span class="choice">Disagree</span>
                                </div>
                                <textarea placeholder="What do you think?"></textarea>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <article>

                <h1>{{ $article->title }}</h1>
                @foreach ($paragraphs as $p)
                    {{"<p name=\"$p->id\">$p->text</p>"}}
                @endforeach
            </article>

            <div class="general-comments-container">

                <div class="view first">
                    <div class="comments-container">
                        <div class="comments-count">35 Comments</div>
                        <div class="title">Agreeing comments</div>
                        <div class="comment-list">
                            <div class="comment">
                                <div class="column">
                                    <span class="image-circle"><img src="/img/henco.jpg"></span>
                                    <span class="indicator green"></span>
                                    <div class="vote-container">
                                        <div class="direction">
                                            <span class="count">18</span>
                                            <span class="glyphicon glyphicon-chevron-up green"></span>
                                        </div>
                                        <div class="direction">
                                            <span class="count">3</span>
                                            <span class="glyphicon glyphicon-chevron-down red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="name">Henco Appel</span>
                                    <span class="desc">
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                    </span>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="column">
                                    <span class="image-circle"><img src="/img/samir.jpg"></span>
                                    <span class="indicator green"></span>
                                    <div class="vote-container">
                                        <div class="direction">
                                            <span class="count">9</span>
                                            <span class="glyphicon glyphicon-chevron-up green"></span>
                                        </div>
                                        <div class="direction">
                                            <span class="count">2</span>
                                            <span class="glyphicon glyphicon-chevron-down red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="name">Samir Moussa</span>
                                    <span class="desc">
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                    </span>
                                </div>
                            </div>

                        <div class="comment-add"><span class="glyphicon glyphicon-plus-sign"></span>Add a comment</div>

                        </div>
                        
                    </div>
                </div>

                <div class="view">
                    <div class="comments-container">
                        <div class="comments-count">12 Comments</div>
                        <div class="title">Disagreeing comments</div>
                        <div class="comment-list">
                            <div class="comment">
                                <div class="column">
                                    <span class="image-circle"><img src="/img/henco.jpg"></span>
                                    <span class="indicator red"></span>
                                    <div class="vote-container">
                                        <div class="direction">
                                            <span class="count">18</span>
                                            <span class="glyphicon glyphicon-chevron-up green"></span>
                                        </div>
                                        <div class="direction">
                                            <span class="count">3</span>
                                            <span class="glyphicon glyphicon-chevron-down red"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="name">Kostadin Stoilov</span>
                                    <span class="desc">
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                        Here is some comment
                                    </span>
                                </div>
                            </div>

                        <div class="comment-add"><span class="glyphicon glyphicon-plus-sign"></span>Add a comment</div>

                        </div>
                        
                    </div>
                </div>

            </div>

    	</div>

    </body>


</html>