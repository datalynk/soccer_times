<?php

$submitter_number = $_POST['submitter_number'];

    /* Send an SMS using Twilio. You can run this file 3 different ways:
     *
     * - Save it as sendnotifications.php and at the command line, run 
     *        php sendnotifications.php
     *
     * - Upload it to a web host and load mywebhost.com/sendnotifications.php 
     *   in a web browser.
     * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
     *   directory to the folder containing this file, and load 
     *   localhost:8888/sendnotifications.php in a web browser.
     */
 
    // Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.
    require "twilio_library/Services/Twilio.php";

    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC2dc285374bc24270ac8b84a4a5322c9c";
    $AuthToken = "d479838d2b77952f920e735634468cb6";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    $people = array(
		$submitter_number => "Soccer Fan",
    );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    foreach ($people as $number => $name) {
 
        $sms = $client->account->sms_messages->create(
 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the Sandbox number
            "415-702-3308", 
 
            // the number we are sending to - Any phone number
            $number,
 
            // the sms body
            "Hey $name. Good news. Now youll get an alert right before this game begins!"
        );
 
        // Display a confirmation message on the screen
        echo "Sent message to $name";
    }
?>