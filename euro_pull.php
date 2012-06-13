<?php

include('simple_html_dom.php');

$html = file_get_html('http://www.uefa.com/uefaeuro/season=2012/matches/all/index.html');



echo $html->getElementById("md_2_2")->childNodes(1);
//echo $html->getElementById("div1")->childNodes(1)->childNodes(1)->childNodes(2)->getAttribute('id');





/*


/*

foreach($html->find('table[class]') as $e)
	echo $e->plaintext;
*/



// Find the DIV tag with an id of "myId"
/*
foreach($html->find('div#matchesindex table.date20120613') as $e) 
    echo $e->plaintext . '<br>';


	foreach($html->find('td') as $e)
	    echo $e->innertext . '<br>';
*/



?>