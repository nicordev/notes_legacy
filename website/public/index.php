<?php

use MyNotes\Autoloader;
use MyNotes\Application;

require dirname(__DIR__) . "/src/Autoloader.php";

Autoloader::register();

$app = new Application();
$app->run();