<html>

	<head>
	
		<title>MercuryMVC - Default Homepage</title>
		<style type="text/css">
			
			body {
				font-family: sans-serif, arial;
				font-size: 13px;
				color: #222;
			}
			
			.clear {
				clear: both;
			}
			
			.container {
				width: 800px;
				margin-left: auto;
				margin-right: auto;
				margin-top: 32px;
				border: 1px solid #c4c4c4;
				box-shadow: 0px 2px 10px rgba(0,0,0,0.2);
				padding: 32px;
			}
			
			h1 {
				color: #313131;
				font-size: 25px;
				opacity: 0.7;
			}
			
			p.block {
				border: 1px solid #dbdbdb;
				margin: 16px 10px;
				padding: 7px 14px;
				float: left;
				font-family: Courier, "Courier New";
				font-size: 12px;
				margin-top: 0px;
				font-weight: bold;
				color: #5b2c2c;
			}
			
			p {
				line-height: 1.5;
			}
			
		</style>
	
	</head>
	<body>
	
		<div class="container">
			
			<h1>Welcome to MercuryMVC</h1>
			
			<p>This is the default controller in MercuryMVC. This is a simple placeholder page, and all the controller is doing, is including a view into its end-output. The default controller is always 'index' and can also be loaded from <a href="/index">/index</a>.</p>
			
			<p><br />To customise this view go to</p>
			
			<p class="block">
				<?php echo APP_PATH; ?>views/welcome.php
			</p>
			
			<div class="clear"></div>
			
			<p>
				Views can be parsed with PHP too, and allow custom pages using a single layout. You are free to delete, edit or add more controllers, views and models at your hearts consent.
			</p>
			
			<p>
				And please remember that this is a work in progress framework, so by using this framework at 'this' stage, you agree that you are using unfinished software. We recommend that you do not use the framework for any large/commercial projects at this stage.
			</p>
			
			<p>
				Have fun!
			</p>
			
		</div>
	
	</body>
	
</html>