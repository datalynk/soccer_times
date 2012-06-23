<?php require_once 'functions.php' ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>When's the upcoming game?</title>
	<META name="description" content="Find out what time the sport game will be at.">
	<meta name="keywords" content="game time, sports times, upcoming game times, sports match times, soccer match time, soccer game time, football gametime, futbol game timeseurocup gametimes, what time is the game at, when is the game">


	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/libs/modernizr-2.5.2.min.js"></script>
</head>
<body>
	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
	
	<div id="main_wrap">
		<div class="transparency"> </div>
		<div id="content">
			<header>
				<img class="bigline" src="img/line.png"/>
				<img class="logo" src="img/soccerlogo.png"/>
				<img class="bigline" src="img/line.png"/>
				<nav>
					<a href="mailto:alex@newspanion.com?Subject=Hello!"><img class="email_logo" src="img/e-maillogo.png"/></a>
				</nav>
			</header>

			<!-- Search section for what game a user is looking for -->
		
			<div id = "what_game">
				<div class="pre_search">
					<h2 class="search_game_title">WHAT GAME ARE YOU LOOKING FOR?</h2>
					<img class="venn" src="img/venn-diagram.png"/>			
					<a class="go" href="#"></a>
					<div id="input_holder">
						<input type="text" id="teamy1" placeholder="ENTER TEAM 1" /> 
						<input type="text" id="teamy2" placeholder="ENTER TEAM 2" />
	            	</div>
				</div>
				<button class="search_games"></button>
			</div>
			
			<div class="search_results">
		<!--	
				<div class="button_nav">
					<button class="search_butt"></button>
					<button class="tweet_butt"></button>
					<button class="alert_butt"></button>
					<button class="buy_butt"></button>
				</div>
		-->	
				<button class="new_search"> </button>
			</div>

			<!-- Upcoming Games section. Shows games that will be coming up soon. -->
			<div id="upcoming_games_title">
				<img src="img/littleline.png"/>
				<h2 class="upcoming_games_title">Upcoming Games</h2>
				<img src="img/littleline.png"/>
			</div>
			<div class="upcoming_banner"></div>
			
			<div id="upcoming"><?php printMatchedGames() ?> </div>
			<div class="response"></div>
		</div>
		
		<div id="text_message_lb">
			<img src="img/closebutton.png" href="#" class="close_button"/>
			<h2>Fill in your e-mail and phone number to receive text message alerts for the next upcoming game.</h2>
				<form class="text_alert">
					<input type="text" id="contact_name" placeholder="your name"/> 
					<input type="text" id="contact_email" placeholder="your email"/>
					<p>And/Or </p>
					<input type="text" id="contact_phone" placeholder="your phone number"/> 
					<p> Alert Me </p>
					<div id="time_settings">
						<select id="time_value">
							<?php
							$values = array(1,2,3,4,5,6,7,8,9,10,15,20,25,30);
							foreach($values as $value) { ?>
							
								<option value="<?=$value?>"><?=$value?></option>
							<?php
							} ?>
						</select>
						<select id="time_unit">
							<!--<option value="minutes">minutes</option>-->
							<option value="hours">hours</option>
							<option value="days">days</option>
						</select> 
						before game   
					</div>
				</form>
			<button class="alert_button">GET ALERTS</button>
		</div>
	</div>
	<footer>

	</footer>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-32833497-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</body>




</html>