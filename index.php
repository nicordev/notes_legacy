<?php

use MyNotes\Autoloader;
use MyNotes\Application;

require "src/Autoloader.php";

Autoloader::register();

$app = new Application();
$app->run();