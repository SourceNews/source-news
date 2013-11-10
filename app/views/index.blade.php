<!DOCTYPE html>
<html>

	<head>
        <title>Source News</title>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
        <link href="./css/general.css" rel="stylesheet" media="screen">
        <script type='text/javascript' src="./js/jquery-1.10.1.min.js"></script>
        <script type='text/javascript' src="./js/script.js"></script>
    </head>

    <body class="login">
    	<div class="side">
    		<div class="logo"><span class="glyphicon glyphicon-globe"></span>source<span>news</span></div>
    		<div class="slogan">A place for everyone's opinion.</div>
            <div class="reg">
    			<div class="signin">
    				<span class="option signup-btn open">Register</span>
    				<span class="option signin-btn">Sign In</span>
    			</div>      
    		    			
				{{ Form::open(array('action' => 'RegistrationController@store')) }}
    				<input type="text" name="username" value="{{ Input::old('username', '') }}" placeholder="Username"/>
    					<span class="error">@if($errors->has('username')) {{ $errors->first('username') }} @endif</span>
	                <input id="email_field" type="text" name="email" value="{{ Input::old('email', '') }}" placeholder="Email"/>
	                   <span class="error">@if($errors->has('email')) {{ $errors->first('email') }} @endif</span>
	    			<input type="password" name="password" placeholder="Password"/>
	    				<span class="error">@if($errors->has('password')) {{ $errors->first('password') }} @endif</span>
	                <div class="form-buttons">
	                    <button id="submit_btn" type="submit">Register</button>
	                    <button class="login-social first">Facebook</button>
	                    <button class="login-social">Twitter</button>
	                </div>
				{{ Form::close() }}	
            </div>           
    	</div>

    	<div class="main">
    		<div class="intro">
            Source News is a unique platform that provides an alternative way to reading the news. We encourage readers to support or question the views of news corporations and journalists through an effective inline commenting system and elegant interface, giving future readers a more balanced opinion across a broad range of topics.<br><br>Our aim is to leverage discussion and better inform the world.</div>
    	</div>

    </body>


</html>