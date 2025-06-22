<?php
/* ---------------- bootstrap ------------------ */

ini_set('display_errors', 1);     // <- set to 0 in production
error_reporting(E_ALL);

session_start();

/* ---- core includes ---- */
require_once 'core/config.php';
require_once 'database.php';
require_once 'core/Controller.php';
require_once 'core/App.php';
require_once CORE . DS . 'Flash.php';
