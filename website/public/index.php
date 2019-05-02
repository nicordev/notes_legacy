<?php

use MyNotes\Autoloader;
use MyNotes\Application;

define("ROOT", dirname(__DIR__));

require ROOT . "/src/Autoloader.php";

Autoloader::register();

$app = new Application();
$app->run();