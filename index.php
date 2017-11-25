<?php

error_reporting(E_ALL);

define('ROOT_DIR', dirname(__FILE__));

use Core\Config;
use Core\Routing;

require_once 'app/Autoloader.php';

//Load composer's autoloader
require ROOT_DIR . '/vendor/autoload.php';

(new Config())->applyConfig();

(new Routing())->runApplication($_SERVER);