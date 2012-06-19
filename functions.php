<?php

require_once 'EasyDB.php';
require_once "twilio_library/Services/Twilio.php";
define('SENT',1);
define('NOT_SENT',0);
define('EMAIL','alerts@sportstimes.com');
define('TWILIO_ID','AC2dc285374bc24270ac8b84a4a5322c9c');
define('TWILIO_TOKEN','d479838d2b77952f920e735634468cb6');
define('TWILIO_NUMBER','415-702-3308');
define('GEONAME_USERNAME','shaunpersad');

/* Tandy's local database */
/*
$config = array( 'host' => 'localhost',
				 'user' => 'root',
				 'password' => 'root',
				 'dbname' => 'sports_times');	
*/
/*Shaun's local database */	
/*			 
$config = array( 'host' => 'localhost',
				 'user' => 'root',
				 'password' => '',
				 'dbname' => 'sports_times');				 
*/
/*Shaun's live database */	
			 
$config = array( 'host' => 'mysql.boredmap.com',
				 'user' => 'times_user',
				 'password' => 'ilovelamp',
				 'dbname' => 'sports_times');				 
				 				 
$db = new EasyDB($config);

function getMatchedGames($team1, $team2) {
	
	global $db;
	$now = time();
	
	if($team1 == '') {
		
		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "%$%") AND date_time > $ ORDER BY date_time',array($team2,$now));		
	}
	else if($team2 == '') {

		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "%$%") AND date_time > $ ORDER BY date_time',array($team1,$now));		
	}
	else {
	
		$result = $db->query('SELECT * FROM games WHERE (teams LIKE "$%$" OR teams LIKE "$%$") AND date_time > $ ORDER BY date_time',array($team1,$team2,$team2,$team1,$now));
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
	country
	timezone
	timezone_abbr
	date_time
	other
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
			$ungeocoded_location = $description[1]; //the second description piece is the location
			$date_time = $description[2];   // the third description piece is the date and time of the event
			
			/* Send the address to google.  
			This sends back the location lat and lng, as well as a full address, 
			which is useful to bring all addresses to a common format. */
			$geocoding_response = json_decode(@file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($ungeocoded_location).
																 												 '&sensor=false'));																					 
			//full address																									 
			$location = $geocoding_response->results[0]->formatted_address;
			
			/* Send the lat and lng to geoname to get the timezone */
			$url = 'http://api.geonames.org/timezoneJSON?formatted=true&lat='.$geocoding_response->results[0]->geometry->location->lat.
																	  '&lng='.$geocoding_response->results[0]->geometry->location->lng.
																	  '&username='.GEONAME_USERNAME.
																	  '&style=full';
			$geoname_response = json_decode(@file_get_contents($url));	
																					
			$country = $geoname_response->countryName;
			$timezone = $geoname_response->timezoneId;
			
			$dateTime = new DateTime();
			$dateTime->setTimeZone(new DateTimeZone($timezone));
			$abbreviation = $dateTime->format('T'); 
				
			$game = array();
			$game['sport'] = $sport;
			$game['category'] = $category;
			$game['match_name'] = trim(strtolower($match_name_and_teams[0]));
			$game['teams'] = trim(str_replace('tickets','',strtolower($match_name_and_teams[1]))); //makes teams lowercase, then removes the word "tickets", then removes spaces
			$game['location'] = $location;
			$game['country'] = $country;
			$game['timezone'] = $timezone;
			$game['timezone_abbr'] = $abbreviation;
			$game['date_time'] =  strtotime(ConvertTimezoneToAnotherTimezone($date_time,$timezone,date_default_timezone_get()));
			$game['other'] = $item->link;
				
			$db->insertOrUpdateIfExists('games',$game,$game);				
		}
		
		return true;
	}	
}

function sendAlerts() {
	
	global $db;
	// get past alerts, starting 15 minutes into the future (to accomodate for delays)
	$time_plus_fifteen_minutes = time() + (15*60);
	$result = $db->query('SELECT * FROM alerts WHERE (time_of_alert < $) AND status = '.NOT_SENT,array($time_plus_fifteen_minutes));	
	// get past alerts, starting two minutes into the future (to accomodate for delays)
	$time_plus_two_minutes = time() + (2*60);
	$result = $db->query('SELECT * FROM alerts WHERE (time_of_alert < $) AND status = '.NOT_SENT,array($time_plus_two_minutes));	

	$system_timezone = date_default_timezone_get();

	while($alert = mysql_fetch_assoc($result)) {
		
		$game = $db->selectOne('*','games',array('id'=>$alert['game_id']));

    	date_default_timezone_set($game['timezone']);

		$game_time = date("g:i a, F j, Y",$game['date_time']). ' ('.$game['timezone_abbr'].')';
						
		$message = 'Hi there!  This is your alert for '.$game['teams'].', on '.$game_time;
		$message.= "<br />It's ".$alert['time_diff_value'].' '.$alert['time_diff_unit'].' away!';		
	
		if($alert['contact_type'] == 'email') {

			$headers = 'From: Sports Times <' .EMAIL. '>' . "\r\n";	
			$headers.= "MIME-Version: 1.0\r\n";
			$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$subject = 'Alert for: '.$game['teams'];
					
			mail($alert['contact_info'],$subject,$message,$headers);	
			$db->update('alerts',array('status'=>SENT),array('id'=>$alert['id']));
	
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
			$db->update('alerts',array('status'=>SENT),array('id'=>$alert['id']));
					
		}
	}
	date_default_timezone_set($system_timezone);		
	
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
	global $db;
	$game = $db->selectOne('*','games',array('id'=>$game_id)); //get game
	
	//get time difference, depending on the interval
	
	if (strpos($time_unit,'day') !== false) {
					
		$time_of_alert = $game['date_time'] - ($time_value * 60*60*24); 
	}
	else if (strpos($time_unit,'hour') !== false) {
					
		$time_of_alert = $game['date_time'] - ($time_value * 60*60);
	}
	else if (strpos($time_unit,'minute') !== false) {
					
		$time_of_alert = $game['date_time'] - ($time_value * 60);
	}
	
	if($time_value == 1) {
		
		$time_unit = str_replace('s','',$time_unit);	
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

	return $db->insertOrUpdateIfExists('alerts',$alert,$alert);	
}

function getTimeDifference($date_time) { //gets the difference between now and the specified time
	
	$difference = $date_time - time();
	
	if($difference/86400 >= 1) {
		
		$return = round($difference/86400). ' days';
	}
	elseif($difference/3600 >= 1) {
		
		$return = round($difference/3600). ' hours';
	}
	elseif($difference/60 >= 1) {
		
		$return = round($difference/60). ' minutes';
	}
	else {
		$return = $difference .' seconds';
	}

	return $return;	
}

function ConvertTimezoneToAnotherTimezone($time,$currentTimezone,$timezoneRequired)
{
    $dayLightFlag  = false;
    $dayLgtSecCurrent = $dayLgtSecReq = 0;
    $system_timezone = date_default_timezone_get();
    $local_timezone = $currentTimezone;
    date_default_timezone_set($local_timezone);
    $local = date("Y-m-d H:i:s");
    
     $daylight_flag = date("I",strtotime($time));
     if($daylight_flag == 1){ 
	    $dayLightFlag  = true;
	    $dayLgtSecCurrent = -3600;
    }
    date_default_timezone_set("GMT");
    $gmt = date("Y-m-d H:i:s ");
 
    $require_timezone = $timezoneRequired;
    date_default_timezone_set($require_timezone);
    $required = date("Y-m-d H:i:s ");
    
    $daylight_flag = date("I",strtotime($time));
    if($daylight_flag == 1){ 
	    $dayLightFlag  = true;
	    $dayLgtSecReq = +3600;
    }
    
    date_default_timezone_set($system_timezone);  
  
    $diff1 = (strtotime($gmt) - strtotime($local));
    $diff2 = (strtotime($required) - strtotime($gmt));

    $date = new DateTime($time);
       
    $date->modify("+$diff1 seconds");
    $date->modify("+$diff2 seconds");
    
    if($dayLightFlag){ 
	   $final_diff =  $dayLgtSecCurrent + $dayLgtSecReq;
	   $date->modify("$final_diff seconds");
    }
    
    $timestamp = $date->format("Y-m-d H:i:s ");
       
    return $timestamp;
}

?>