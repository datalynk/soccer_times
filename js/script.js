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

function make_alerts() {
	
	var games = new Array();
	var raw_id;
	var game_id;
	$('.alert_checkbox:checked').each(function(index,element) {
			
		raw_id = $(this).attr('id').split('_');
		game_id = raw_id[1];
		games.push(game_id);			
	});
		
	if(games.length > 0) {
	
		var tosend = {
				action:'make_alert',
				games:games.join('_'),
				contact_name:$('#contact_name').val(),
				contact_email:$('#contact_email').val(),
				contact_phone:$('#contact_phone').val(),
				time_value:$('#time_value option:selected').val(),
				time_unit:$('#time_unit option:selected').val()
	
		};
		$.post('ajax.php', tosend, function(response) {	
		
			alert(response);
		});
	}
	
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

$('.alert_button').click(function() {
	make_alerts();
});

//open up lightbox when "Alert Me" is clicked
$('tr th:last-child').click(function() {
	$('#text_message_lb').show();
});

// allow user to close lightbox
$('.close_button').click(function() {
	$('#text_message_lb').hide();
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









