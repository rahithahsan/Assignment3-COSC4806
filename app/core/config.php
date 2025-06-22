<?php
/*------------------------------------------------
 | Core constants
 *-----------------------------------------------*/
define('VERSION', '1.0.0');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));       // one level above /core
define('APPS', ROOT);
define('CORE', APPS . DS . 'core');
define('MODELS', APPS . DS . 'models');
define('VIEWS', APPS . DS . 'views');
define('CONTROLLERS', APPS . DS . 'controllers');

/*------------------------------------------------
 | Pull DB constants from separate file
 *-----------------------------------------------*/
require_once APPS . '/config/database.php';
