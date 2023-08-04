<?php 
require_once("./db/config.php");
require_once("./utils/helpers.php");

if(!isset($_GET['JACE_MUAN'])) {
  redirect('../');
}

if(isset($_GET['JACE_MUAN']) && isset($_GET['tb'])) {
  try {
    global $connect;
    $table = $_GET['tb'];
  
    $sql = "TRUNCATE TABLE $table";
    $result = $connect->query($sql);
    $result->execute();
    print_r("Cleared");
  } catch (Exception $e) {
    print_r("Error: " . $e->getMessage());
  }
}