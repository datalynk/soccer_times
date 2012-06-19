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
	
	$games = getMatchedGames(trim(strtolower($_POST['team1'])),trim(strtolower($_POST['team2'])));
	
	if(count($games) > 0) { ?>
		
    <table class="game_info">
      <tr>
      
        <th class="game_column" width="200">Teams</th>
        <th class="game_column" width="200">Match</th>
        <th class="game_column" width="200">Location</th>
        <th class="game_column" width="200">Country</th>
        <th class="game_column" width="200">Game Time</th>
        <th class="game_column" width="200">Time Left</th>
        <th class="game_column" width="200">Tickets</th>
        <th class="alert_me" width="200">Alert Me</th>
        
      </tr>
      <?php
	  
		foreach($games as $game) {

			$time_difference = getTimeDifference($game['date_time']);
			
			$system_timezone = date_default_timezone_get();
			
    		date_default_timezone_set($game['timezone']);

			$game_time = date("g:i a, F j, Y",$game['date_time']). ' ('.$game['timezone_abbr'].')';
			
			date_default_timezone_set($system_timezone);

			$explode = explode(',',$game['location']);
			$short_location = $explode[0];
			 ?>
            <tr>
				<td><?=$game['teams']?></td>
				<td><?=$game['match_name']?></td>
				<td><?=$short_location?></td>
				<td><?=$game['country']?></td>
				<td class="game_time"><?=$game_time ?></td>
				<td><?=$time_difference?></td>
				<td><a href="<?=$game['other']?>">buy</a></td>
                <td><input type="checkbox" class="alert_checkbox" id="alert_<?=$game['id']?>" /></td>
                
			</tr>	
			<?php	
		} ?>	  

    </table>
    
     
	<?php	

	}
	else {
		echo 'No matching games.';
	}
	
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