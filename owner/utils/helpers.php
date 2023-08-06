<?php


function redirect(string $url)
{
  header("Location: $url");
}

function getGreeting()
{
  $hour = date("H");

  if ($hour >= 0 && $hour < 12) return "Morning";
  else if ($hour >= 12 && $hour < 16) return "Afternoon";
  else return "Evening";
}

function generateParcelID()
{
  return join("", explode(".", uniqid("DSD", true)));
}

function setAlert(string $message, string $type = "error")
{
  $_SESSION['ADMIN_ALERT'] = json_encode([
    "message" => $message,
    "type" => $type
  ]);
  return true;
}

function sanitizer(string $string): string
{
  return htmlspecialchars(trim($string));
}

function isReadyForClaiming ($dateString) {
  $now = new DateTime();
  $inputDate = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
  return $now >= $inputDate;
}

function humanReadableTimeFormat($dateString) {
  $now = new DateTime();
  $inputDate = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);

  if ($inputDate > $now) {
    return $inputDate->format('M d, Y');
  } else {
    $interval = $now->diff($inputDate);
    $daysAgo = $interval->days;
    if ($daysAgo === 0) {
      return "today";
    } elseif ($daysAgo === 1) {
      return "yesterday";
    } else {
      return $daysAgo . " days ago";
    }
  }
}
