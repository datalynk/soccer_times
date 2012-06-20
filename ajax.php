<?php

require_once 'functions.php';

$action = $_REQUEST['action'];

if($action == 'get_matched_games') {
	
	
	
	if(!isset($_POST['team1'])) {
		
		$_POST['team1'] = '';
	}

	if(!isset($_POST['team2'])) {
		
		$_POST['team2'] = '';
	}
	
	printMatchedGames($_POST['team1'],$_POST['team2']);
	
}
else if($action == 'update_database') {
	
	if(updateTicketcity()) {
	
		echo 'Database updated';	
	}
}
else if($action == 'send_alerts') {
	
	sendAlerts();	
}
else if($action == 'make_alert') {
	
	$games = explode('_',$_POST['games']);
	foreach($games as $game_id) {	
	
		if(filter_var(trim($_POST['contact_email']), FILTER_VALIDATE_EMAIL)) {
	
			makeAlert(trim($_POST['contact_name']),
					 'email',
					 trim($_POST['contact_email']),
					 intval($game_id),
					 intval($_POST['time_value']),
					 trim($_POST['time_unit']));
		}
		if(trim($_POST['contact_phone']) > 0) {
	
			makeAlert(trim($_POST['contact_name']),
					 'text',
					 trim($_POST['contact_phone']),
					 intval($game_id),
					 intval($_POST['time_value']),
					 trim($_POST['time_unit']));
		}		
		

	}
	echo 'success';
}