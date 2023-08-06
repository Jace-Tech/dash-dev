<?php 

// $MODE = "DEV";
$MODE = "PROD";

// SERVER

if($MODE !== "DEV") {
  define("HOST", "localhost");
  define("USER", "dashdeli_root");
  define("PASSWORD", ")C,(VaW@GW}Q");
  define("DB_NAME", "dashdeli_log");
}
else {
  // LOCAL 
  define("HOST", "localhost");
  define("USER", "root");
  define("PASSWORD", "");
  define("DB_NAME", "log");
}

try {
  $dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME;
  $connect = new PDO($dsn, USER, PASSWORD);
  
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(Exception $e) {
  die("<p>Can't connect to database; Please contact the developer 🙃</p>");
}