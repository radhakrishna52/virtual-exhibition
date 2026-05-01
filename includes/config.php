<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration - reads from env vars (Railway) or falls back to local defaults
define('DB_HOST', getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('MYSQLUSER') ?: getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('MYSQLPASSWORD') ?: getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('MYSQL_DATABASE') ?: getenv('DB_NAME') ?: 'virtual_exhibition');
define('DB_PORT', (int)(getenv('MYSQLPORT') ?: getenv('DB_PORT') ?: 3306));

// Site configuration
define('SITE_URL', getenv('SITE_URL') ?: 'http://localhost:8000');
define('UPLOAD_DIR', 'uploads/');

// Include other required files
require_once 'db.php';
require_once 'functions.php';
require_once 'auth.php';
?>