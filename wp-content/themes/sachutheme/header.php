<html>
	<head>
		<meta charset ="UTF-8">
		<meta name="description" content="lifestyle blog for the average jane">
		<meta name="keywords" content="finance, home, love, life, family, india, indian, fashion, beauty">
		<meta name="author" content="Saraswathi Arun">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
		<meta name="p:domain_verify" content="06a0ec460635471e9812ffd5fe8a564f"/>
		
		<title><?php bloginfo('title'); ?></title>

		<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Neuton|Sacramento" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>

		<link rel="stylesheet" type="text/css" media="all" href="<?php echo ($_SERVER[HTTP_HOST] == 'localhost:8888') ? get_template_directory_uri() . '/style.css' : 'https://s3.us-east-2.amazonaws.com/meanderingpaths/css/style.css'; ?>">
		<!--link rel="stylesheet" type="text/css" media="all" href="https://s3.us-east-2.amazonaws.com/meanderingpaths/css/style.css"-->
		<script src="<?php echo ($_SERVER[HTTP_HOST] == 'localhost:8888') ? get_stylesheet_directory_uri() . '/script.js' : 'https://s3.us-east-2.amazonaws.com/meanderingpaths/javascript/script.js'; ?>"></script>
		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			  ga('create', 'UA-85120670-1', 'auto');
			  ga('send', 'pageview');
		</script>
		<?php wp_head();?>
	</head>
	<body>
		<header class="site-header">
		<div class="jumbotron header-bg">
		</div>
		<nav class="navbar navbar-default">
  			<div class="container-fluid">
  				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
       				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
       				<span class="icon-bar"></span>                        
      			</button>
      			<div class="collapse navbar-collapse" id="myNavbar">
	    			<ul class="nav navbar-nav">
				      	<li><a href="/wordpress"> <i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				      	<li><a href="/wordpress/travel/"> <i class="fa fa-plane" aria-hidden="true"></i> Travel</a></li>
				      	<li class="dropdown">
				      		<a class "dropdown-toggle" data-toggle="dropdown" href="/wordpress/lifestyle"> <i class="fa fa-play-circle" aria-hidden="true"></i> Lifestyle</a>
				      		<ul class="dropdown-menu menu-wrap">
						      	<li class="feature-list">
						      		<a class ="feature-list-india" href="/wordpress/holidays/">Holidays</a>
						      	</li>
						      	<li class="feature-list">
						      		<a class ="feature-list-india" href="/wordpress/personal-development/">Personal Development</a>
						      	</li>
						    </ul>
						</li>

	    				<!-- *GD<li class="dropdown"> 
	    					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	    						<i class="fa fa-map-signs" aria-hidden="true"></i> Lifestyle<span class="caret"></span>
	    					</a>
	      					<ul class="dropdown-menu cat-full menu-wrap">
						      	<div class="col-md-3">
						      	
						      			<li class="feature-list-top">
						      				<a class ="feature-list-india" href="#">Living in India</a>
						      			</li>

										<li class="feature-list-top">
											<a class="feature-list-canada" href="#">Living in Canada</a>
										</li>

						  				<li class="feature-list-bottom">
						  					<a class="feature-list-travel" href="#">Travel</a>
						  				</li>
						      	</div>
						      	<div class="col-md-9">
						  			<ul class="menu-india">
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg" style="height:25%">
											<li> Blog Post 1</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg"  style="height:25%">
											<li> Blog Post 2</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg"  style="height:25%">
											<li> Blog Post 3</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
									</ul>
									<ul class="menu-canada">
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg" style="height:25%">
											<li> Blog Post 4</li>
											<span class="entry-date"> 5th September 2016</span>
										</div>
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg" style="height:25%">
											<li> Blog Post 5</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg"  style="height:25%">
											<li> Blog Post 6</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
									</ul>
									<ul class="menu-travel">
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg" style="height:25%">
											<li> Blog Post 7</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg"  style="height:25%">
											<li> Blog Post 8</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
										<div class="col-md-4 feature-post">
											<img src="/wordpress/wp-content/themes/sachutheme/images/paths.jpg"  style="height:25%">
											<li> Blog Post 9</li>
											<span class="entry-date"> 3rd July 2016</span>
										</div>
									</ul>
								</div>
	      					</ul>
	    				</li> -->
	      				<li><a href="/wordpress/about-me"><i class="fa fa-user-secret" aria-hidden="true"></i> About Me</a></li>
	    			</ul>
  				</div>
  			</div>
		</nav>
	</header>