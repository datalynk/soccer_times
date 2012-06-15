<?php

require_once 'functions.php';

$action = $_REQUEST['action'];

if($action == 'get_matched_games') {
	
	$games = getMatchedGames(trim(strtolower($_POST['team1'])),trim(strtolower($_POST['team2'])));
	
	
	if(count($games) > 0) { ?>
		
    <table class="game_info">
      <tr>
      <?php
	  $columns = array_keys($games[0]);
		  
	  foreach($columns as $column) { ?>
		  
        <th class="game_column" width="200"><?=$column?></th>
		<?php
	  } ?>
      </tr>
      <?php
	  
		foreach($games as $game) { ?>
			
            <tr>
            <?php
			foreach($game as $key=>$value) {
				$class = "";
				if (strpos($key,'date_time') !== false) {	
					$class = 'class="game_time"';				
				}				
				
				if (strpos($key,'date') !== false) {
					
					$value = date("F j, Y, g:i a",strtotime($value));
				}
				elseif($key == 'other') {
					
					$value = '<a href="'.$value.'">buy tickets</a>';
						
				}
			?> 
            	<td <?=$class?> ><?=$value?></td>
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