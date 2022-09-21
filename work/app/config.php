<?php
session_start();

define('DSN','mysql:host=db;dbname=myapp;charset=utf8mb4');
define('DB_USER','myappuser');
define('DB_PASS','myapppass');
define('SITE_URL','http://localhost:8562');

require_once(__DIR__ . '/functions.php');
