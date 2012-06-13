<?php

include('simple_html_dom.php');

$html = file_get_html('http://www.uefa.com/uefaeuro/season=2012/matches/all/index.html');



echo $html->getElementById("md_2_2")->childNodes(1);



?>