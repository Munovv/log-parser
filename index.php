<?php

declare(strict_types=1);

use Munovv\LogParser\AccessParser as AccessParser;

require_once "vendor/autoload.php";

//$file = '/Applications/MAMP/logs/apache_access.log'; MAMP macOS apache_access.log
$access = 99.9;
$timeout = 45;
$file = 'access.log';

$access_parser = new AccessParser();
$access_parser->run($file, $access, $timeout);


 ?>
