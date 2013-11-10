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

    <body class="feed">
        
        <div class="side">
            <div class="logo"><span class="glyphicon glyphicon-globe"></span>source<span>news</span></div>
            <span class="hello">Hello, {{$user->username}}</span>
            
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
            	@if(isset($feed) && is_object($feed))
	                <span class="title">My RSS Feeds</span>
	                <ul>
	                    <li><a href="/feed/{{$feed->id}}">Guardian</a></li>
	                </ul>
	            @endif
                <div class="rss">
                	{{ Form::open(array ('action' => 'RssFeedController@loadRss', 'method' => 'get')) }}
                    <input type="text" name="rss" placeholder="URL"/>
                    <div class="comment-add" id="rss-add-url"><span class="glyphicon glyphicon-plus-sign"></span>Add an RSS feed URL</div>
                    {{ Form::close() }}
                    
					<script type="text/javascript">
						$(document).ready(function(){
							$("#rss-add-url").click(function(event){
								$(this).closest("form").submit();
							});	
						});
					</script>                   
                </div>
            </div>

            <div class="footer">
                <a href="/logout">Logout</a>
            </div>

        </div>

        <div class="main">

            <div class="column">
                <h1>Popular</h1>

                <div class="list">
                    <div class="top story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                    
                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                    
                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                </div>

            </div>

            <div class="column col-1">
                <h1>Most debated</h1>

                <div class="list">
                    <div class="top story">
                        <a class="image" href=""><img src=""></a>
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                    
                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                    
                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                </div>

            </div>

            <div class="column col-2">
                <h1>Newest</h1>

                <div class="list">
                    <div class="top story">
                        <a class="image" href=""><img src=""></a>
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                    
                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>

                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                    
                    <div class="story">
                        <h2>Sochi Olympic torch taken on historic spacewalk</h2>
                        <p>Two Russian cosmonauts are taking the torch for the Sochi Winter Olympics on its first space journey ...</p>
                    </div>
                </div>

            </div>

        </div>

    </body>


</html>