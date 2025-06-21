<?php

define('VERSION', '0.7.0');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('APPS', ROOT . DS . 'app');
define('CORE', ROOT . DS . 'core');
define('LIBS', ROOT . DS . 'lib');
define('MODELS', ROOT . DS . 'models');
define('VIEWS', ROOT . DS . 'views');
define('CONTROLLERS', ROOT . DS . 'controllers');
define('LOGS', ROOT . DS . 'logs');	
define('FILES', ROOT . DS. 'files');

/* ---------- Database configuration (updated for Assignment 3) ---------- */
define('DB_HOST', '7x3qv.h.filess.io');
define('DB_PORT', 3305);
define('DB_NAME', 'cosc4806_storyline');
define('DB_USER', 'cosc4806_storyline');
define('DB_PASSWORD', getenv('DB_PASS'));

/* Login-rate-limit settings */
define('MAX_FAILED',      5);   // lock out after 5 bad tries
define('LOCKOUT_SECONDS', 60);  // …for one minute

date_default_timezone_set('America/Toronto');