<<<<<<< HEAD
<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

$root = realpath(dirname(dirname(__FILE__)));
$library = "$root/Services";
$tests = "$root/tests";

$path = array($library, $tests, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));

require_once 'Mockery/Loader.php';
$loader = new \Mockery\Loader;
$loader->register();

require_once 'Twilio.php';

unset($root, $library, $tests, $path);

=======
<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

$root = realpath(dirname(dirname(__FILE__)));
$library = "$root/Services";
$tests = "$root/tests";

$path = array($library, $tests, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));

require_once 'Mockery/Loader.php';
$loader = new \Mockery\Loader;
$loader->register();

require_once 'Twilio.php';

unset($root, $library, $tests, $path);

>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
