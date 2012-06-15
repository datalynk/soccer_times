<?php

require_once 'EasyDB.php';

$config = array( 'host' => 'localhost',
				 'user' => 'root',
				 'password' => '',
				 'dbname' => 'sports_times');	
				 				 
$db = new EasyDB($config);

function getMatchedGames($team1, $team2) {
	
	global $db;
	
	if($team1 == '') {
		
		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "%$%") AND date_time > NOW() ORDER BY date_time DESC',array($team2));		
	}
	else if($team2 == '') {

		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "%$%") AND date_time > NOW() ORDER BY date_time DESC',array($team1));		
	}
	else {
	
		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "$%$" OR teams LIKE "$%$") AND date_time > NOW() ORDER BY date_time DESC',array($team1,$team2,$team2,$team1));
	}
	
	$games = array();
	
	while($game = mysql_fetch_assoc($result)) {
		
		$games[] = $game;		
	}
	return $games;
}

function updateTicketcity() {
	
	/*
	"GAMES" TABLE STRUCTURE:
	sport
	category
	teams
	match_name
	location
	date_time
	date_updated
	
	TICKET CITY RSS STRUCTURE:
	
	<channel>
	
		<title>Euro 2012 Tickets </title>
		<description>Buy or sell Euro 2012 Tickets  at TicketCity</description>
		<link>http://www.ticketcity.com/soccer-tickets/euro-2012-tickets.html</link>
		
		<item>
			<title>06/14 Euro 2012 Match 14 - Spain vs Ireland</title>
			<description>Euro 2012 Match 14 - Spain vs Ireland Tickets, Municipal Stadium Gdansk - Poland, June 14 8:45PM</description>
			<link>http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-14-spain-vs-ireland-tickets-municipal-stadium-gdansk-poland-june-14-845pm.html</link>
		</item>
		<item>
			<title>06/14 Euro 2012 Match 14 - Spain vs Ireland</title>
			<description>Euro 2012 Match 14 - Spain vs Ireland Tickets, Municipal Stadium Gdansk - Poland, June 14 8:45PM</description>
			<link>http://www.ticketcity.com/soccer-tickets/euro-2012-tickets/euro-2012-match-14-spain-vs-ireland-tickets-municipal-stadium-gdansk-poland-june-14-845pm.html</link>
		</item>	
		
	</channel>		
	
	
	*/	
	
	global $db;
	$feed = 'http://www.ticketcity.com/rss/euro-2012-tickets.rss';
			
    $rss = simplexml_load_string(file_get_contents($feed));

	if($rss) {
						
		$sport = 'soccer';
		$category = trim(str_replace('tickets','',strtolower($rss->channel->title))); //makes title lowercase, then removes the word "tickets", then removes spaces
			
		foreach($rss->channel->item as $item) {

			$description = explode(',',$item->description); //breaks item description into 3 pieces
			$match_name_and_teams = explode('-',$description[0]); // first description piece is then broken into two pieces
			$location = $description[1]; //the second description piece is the location
			$date_time = date("Y-m-d H:i:s",strtotime($description[2]));   // the third description piece is the date and time of the event
				
			$game = array();
			$game['sport'] = $sport;
			$game['category'] = $category;
			$game['match_name'] = trim(strtolower($match_name_and_teams[0]));
			$game['teams'] = trim(str_replace('tickets','',strtolower($match_name_and_teams[1]))); //makes teams lowercase, then removes the word "tickets", then removes spaces
			$game['location'] = $location;
			$game['date_time'] = $date_time;
			$game['other'] = $item->link;
				
			$db->insertOrUpdateIfExists('games',$game,$game);				
		}
		
		return true;
	}	
}

?>