// Event Handlers

// instantiate AJAX
var req = new XMLHttpRequest();

$('button.text_alert').click(function() {
	
	var submitter_number = "19253300913";
	var params = "submitter_number="+submitter_number;
	req.open("POST", "sendsms.php", true);
	
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	req.onreadystatechange = function() {
		if(req.readyState == 4 && req.status == 200) {
			var return_data = req.responseText;
			$('.response').text(return_data);
		}
	}
	req.send(params);
});



// "location.php?lat="+position.coords.latitude


