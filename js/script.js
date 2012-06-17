// instantiate AJAX
var req = new XMLHttpRequest();

// pull value from input and send to php script to send a text message.
function submit_and_text() {
	var submitter_number = $('form.text_alert input').val();
	var params = "submitter_number="+submitter_number;
	req.open("POST", "sendsms.php", true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	req.onreadystatechange = function() {
		if(req.readyState == 4 && req.status == 200) {
			var return_data = req.responseText;
			$('.response').text(return_data);
			$('form.text_alert input').val('');
		}
	}
	req.send(params);
}

function get_search_results() {
	
		var tosend = {
				action:'get_matched_games',
				team1:$('#team1').val(),
				team2:$('#team2').val()
		};
		$.post('ajax.php', tosend, function(response) {
					
			if(response) {
					
				$('.search_results').html(response).fadeIn('fast');
			}				
		});		
	
}

function update_database() {
	
		var tosend = {
				action:'update_database'
		};
		$.post('ajax.php', tosend, function(response) {	
		
			alert(response);
		});		
	
}

// --------- Event Handlers ---------- //
$('button.text_button').click(function() {
	submit_and_text();
});

$('form.text_alert input').bind('keypress', function(e){
	if (e.keyCode==13) {
		submit_and_text();
	}
});

$('.search_games').click(function() {
	get_search_results();
});

$('.update_database').click(function() {
	update_database();
});


/*
function countdown() {
	
//		July 1, 2012, 8:45 pm
	// Store the Final Gametime to be used for the ticker. 
	var final_game_time = $('tbody tr:last-child td.game_time').text();


	this.start_time = 
	this.target_time = ".response";
	
	countdown.prototype.init() {
		this.reset();
		setInterval(this.name + '.tick()', 1000);
	}
	
	countdown.prototype.reset() {
		time = this.start_time.split(":");
		this.minutes = parseInt(time_ary[0]);
		this.seconds = parseInt(time_ary[1]);
		this.update_target();
	}
	
}
*/









