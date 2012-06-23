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
			team1:$('#teamy1').val(),
			team2:$('#teamy2').val()
	};
	$.post('ajax.php', tosend, function(response) {
					
		if(response) {

			$(".pre_search").fadeOut("slow",function(a) {
				$('.search_results').append(response).fadeIn('fast');
				$("button.search_games").hide();
				$("button.new_search").show();
				$(".search_results p").remove();
			});
		}	
		
		else {
			$(".search_results").append("<p>No match results found. Try searching for another game.</p>");
		}
			
		$('input#teamy1, input#teamy2').val("");						
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
		
		$('#text_message_lb').html("<p>You will receive updates for the game! Enjoy</p>");
		
		$.post('ajax.php', tosend, function(response) {	
			$('#text_message_lb').fadeOut(4000);
		//	alert(response);
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

$("button.new_search").live("click", function() {
	$(".pre_search").fadeIn("slow");
	$("button.new_search").hide();
	$("button.search_games").show();
	$(".search_results .game_info").remove();
});


$('.alert_checkbox').live("click", function() {
	var isChecked = $('#.alert_checkbox:checked').val()?true:false;
	$('#text_message_lb').show();
	if (isChecked === false) {
		$('#text_message_lb').hide();
	}
});

// allow user to close lightbox
$('.close_button').click(function() {
	$('#text_message_lb').hide();
});

