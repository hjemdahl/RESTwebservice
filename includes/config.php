<?php
// Moment 5 - Webbutveckling III - REST-webbtjänst - Moa Hjemdahl 2019

//Load classfiles automatic
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.class.php';
});

// Database configuration

/*
define("DBHOST", "localhost");
define("DBUSER", "rest");
define("DBPASSWORD", "rest");
define("DBDATABASE", "rest");
*/

define("DBHOST", "studentmysql.miun.se");
define("DBUSER", "mohj1800");
define("DBPASSWORD", "0mn2d4p7");
define("DBDATABASE", "mohj1800");

// Enable error reporting
error_reporting(-1); // Report all type of errors
ini_set("display_errors", 1); // Display all errors