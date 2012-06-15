<?php

require_once 'EasyDB.php';
require_once "twilio_library/Services/Twilio.php";
define('SENT',1);
define('NOT_SENT',0);
define('EMAIL','alerts@sportstimes.com');
define('TWILIO_ID','AC2dc285374bc24270ac8b84a4a5322c9c');
define('TWILIO_TOKEN','d479838d2b77952f920e735634468cb6');
define('TWILIO_NUMBER','415-702-3308');

$config = array( 'host' => 'localhost',
				 'user' => 'root',
				 'password' => 'root',
				 'dbname' => 'sports_times');	
				 				 
$db = new EasyDB($config);

function getMatchedGames($team1, $team2) {
	
	global $db;
	
	if($team1 == '') {
		
		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "%$%") AND date_time > NOW() ORDER BY date_time',array($team2));		
	}
	else if($team2 == '') {

		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "%$%") AND date_time > NOW() ORDER BY date_time',array($team1));		
	}
	else {
	
		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "$%$" OR teams LIKE "$%$") AND date_time > NOW() ORDER BY date_time',array($team1,$team2,$team2,$team1));
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

function sendAlerts() {
	
	global $db;
	// get past alerts, starting two minutes into the future (to accomodate for delays)
	$result = $db->query('SELECT * FROM alerts WHERE (time_of_alert < (NOW() + INTERVAL 2 MINUTE)) AND status = '.NOT_SENT);	
	
	while($alert = mysql_fetch_assoc($result)) {
		
		$game = $db->selectOne('*','games',array('id'=>$alert['game_id']));
			
		$message = 'Hi there!  This is your alert for '.$game['teams'].', on '.date("F j, Y, g:i a",strtotime($game['date_time']));
		$message.= "<br />It's ".$alert['time_diff_value'].' '.$alert['time_diff_unit'].' away!';		
	
		if($alert['contact_type'] == 'email') {

			$headers = 'From: Sports Times <' .EMAIL. '>' . "\r\n";	
			$headers.= "MIME-Version: 1.0\r\n";
			$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$subject = 'Alert for: '.$game['teams'];
					
			mail($alert['contact_info'],$subject,$message,$headers);	
		}
		else if($alert['contact_type'] == 'text') {
			
			$client = new Services_Twilio(TWILIO_ID, TWILIO_TOKEN);

			$people = array(
				$alert['contact_info'] => $alert['contact_name']
			);
		 
			// Step 5: Loop over all our friends. $number is a phone number above, and 
			// $name is the name next to it
			foreach ($people as $number => $name) {
		 
				$sms = $client->account->sms_messages->create(
		 
				// Step 6: Change the 'From' number below to be a valid Twilio number 
				// that you've purchased, or the Sandbox number
					TWILIO_NUMBER, 
		 
					// the number we are sending to - Any phone number
					$number,
		 
					// the sms body
					$message
				);
			}					
		}
	}	
}

function makeAlert($contact_name,$contact_type,$contact_info,$game_id, $time_value, $time_unit) {
	
	/*
	"ALERTS" TABLE STRUCTURE:
		game_id
		contact_name
		contact_type
		contact_info
		time_of_alert
		time_diff_value
		time_diff_unit
		status
		date_added
	*/
	
	$game = $db->selectOne('*','games',array('id'=>$alert['game_id'])); //get game
	
	//get time difference, depending on the interval
	
	if (strpos($time_unit,'day') !== false) {
					
		$time_of_alert = date("Y-m-d H:i:s",strtotime($game['date_time']) - ($time_value * 60*60*24)); 
	}
	else if (strpos($time_unit,'hour') !== false) {
					
		$time_of_alert = date("Y-m-d H:i:s",strtotime($game['date_time']) - ($time_value * 60*60));
	}
	else if (strpos($time_unit,'minute') !== false) {
					
		$time_of_alert = date("Y-m-d H:i:s",strtotime($game['date_time']) - ($time_value * 60));
	}
	// make alert
	$alert['game_id'] = $game['id'];
	$alert['contact_name'] = $contact_name;
	$alert['contact_type'] = $contact_type;
	$alert['contact_info'] = $contact_info;
	$alert['time_of_alert'] = $time_of_alert;
	$alert['time_diff_value'] = $time_value;
	$alert['time_diff_unit'] = $time_unit;
	$alert['status'] = NOT_SENT;

	$db->insert('alerts',$alert);	
}

?>