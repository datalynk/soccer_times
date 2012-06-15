<?php

require_once 'functions.php';

$action = $_REQUEST['action'];

if($action == 'get_matched_games') {
	
	$games = getMatchedGames(trim(strtolower($_POST['team1'])),trim(strtolower($_POST['team2'])));
	
	
	if(count($games) > 0) { ?>
		
    <table>
      <tr>
      <?php
	  $columns = array_keys($games[0]);
		  
	  foreach($columns as $column) { ?>
		  
        <td width="200"><?=$column?></td>
		<?php
	  } ?>
      </tr>
      <?php
	  
		foreach($games as $game) { ?>
			
            <tr>
            <?php
			foreach($game as $key=>$value) {
				
				if (strpos($key,'date') !== false) {
					
					$value = date("F j, Y, g:i a",strtotime($value));
				}
				elseif($key == 'other') {
					
					$value = '<a href="'.$value.'">buy tickets</a>';
						
				}
				 ?> 
            	
            	<td><?=$value?></td>
            <?php
			} ?>
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
		
	if(makeAlert(trim($_POST['contact_name']),
				 trim($_POST['contact_type']),
				 trim($_POST['contact_info']),
				 intval($_POST['game_id']),
				 intval($_POST['time_value']),
				 trim($_POST['time_unit'])) ) {
		
		echo 'success';	
	}
}