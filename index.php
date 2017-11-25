<?php

error_reporting(E_ALL);

use Core\Config;
use Core\Routing;

require_once 'app/Autoloader.php';

define('ROOT_DIR', dirname(__FILE__));

(new Config())->applyConfig();

(new Routing())->runApplication($_SERVER);