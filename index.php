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
<!-- TODO: These inputs need to be hooked up to the backend. I think the best might be through AJAX? -->
			<input type="text" id="teamy1" placeholder="team 1" /> 
			<input type="text" id="teamy2" placeholder="team 2" />
			
			<header>
				<img src="/img/line.png"/>
				<img src="/img/soccerlogo.png"/>
				<img src="/img/line.png"/>
				<nav>
					<a href="#"><img src="/img/e-maillogo.png"/></a>
				</nav>
			</header>

			<!-- Search section for what game a user is looking for -->
			<h2 class="search_game_title">WHAT GAME ARE YOU LOOKING FOR?</h2>
			<div id = "what_game">
				<img class="venn" src="/img/venn-diagram.png"/>			
				<a class="go" href="#"></a>
				<?php include('find.php'); ?>
			</div>
		
			<!-- Upcoming Games section. Shows games that will be coming up soon. -->
			<div id="upcoming_games_title"</div>
				<img src="/img/littleline.png"/>
				<h2 class="upcoming_games_title">Upcoming Games</h2>
				<img src="/img/littleline.png"/>
			</div>
			<div class="upcoming_banner"></div>
			
			<div id="upcoming"><?php echo file_get_contents('http://shaunpersad.com/soccer_times/ajax.php?action=get_matched_games') ?> </div>
			<div class="response"></div>
		</div>
		<div id="sidebar_right">			
		<!--	<div style="background:#000;width:350px; height:260px;font:0px sans-serif;text-align:left;"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="cdtw" width="350" height="240" style="outline:none"><param name="movie" value="http://cdn.countingdownto.com/c/w.swf" /><param name="flashvars" value="eid=87549" /><param name="allowscriptaccess" value="always" /><param name="bgcolor" value="#000000" /><embed name="cdtw" src="http://cdn.countingdownto.com/c/w.swf" flashvars="eid=87549" type="application/x-shockwave-flash" width="350" height="240" allowscriptaccess="always" bgcolor="#000000" style="outline:none"></embed></object><br/></div> -->
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
			<button class="alert_button">Alert me</button>
		</div>
	</div>
	<footer>

	</footer>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>

	<script>
	 var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	 g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	 s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>

</body>

</html>