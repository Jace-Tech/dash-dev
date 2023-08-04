<?php 


function getAdmins() {
  global $connect;
  $sql = "SELECT * FROM admin";
  $result = $connect->query($sql);
  $result->execute();
  return $result->fetch();
}