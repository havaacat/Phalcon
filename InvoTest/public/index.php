<?php

use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Mvc\Application;

// ...
define('APP_PATH',realpath('..').'/');


// Read the configuration
$config = new ConfigIni(APP_PATH . 'app/config/config.ini');

/**
 * Auto-loader configuration
 */
require APP_PATH . 'app/config/loader.php';


/**
 * Load application services
 */
require APP_PATH . 'app/config/services.php';


$app = new Application($di);

echo $app->handle()->getContent();



?>