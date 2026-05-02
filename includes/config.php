<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration - reads from env vars (Railway) or falls back to local defaults
define('DB_HOST', getenv('MYSQLHOST') ?: 'mysql.railway.internal');
define('DB_USER', getenv('MYSQLUSER') ?: 'root');
define('DB_PASS', getenv('MYSQLPASSWORD') ?: '');
define('DB_NAME', getenv('MYSQL_DATABASE') ?: 'virtual_exhibition');
define('DB_PORT', (int)(getenv('MYSQLPORT') ?: 3306));

// Site configuration
define('SITE_URL', getenv('SITE_URL') ?: 'https://virtual-exhibition-production.up.railway.app');
define('UPLOAD_DIR', 'uploads/');

// Include other required files
require_once 'db.php';
require_once 'functions.php';
require_once 'auth.php';
?>