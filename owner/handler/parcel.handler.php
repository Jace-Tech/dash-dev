<?php
session_start();
require_once("../db/config.php");
require_once("../utils/helpers.php");


if (isset($_POST['add-parcel'])) {
  try {
    // PARCEL INFO
    $id = sanitizer($_POST['id']);
    $title = sanitizer($_POST['title']);
    $weight = sanitizer($_POST['weight']);
    $size = sanitizer($_POST['size']);
    $from = sanitizer($_POST['from']);
    $to = sanitizer($_POST['to']);
    $dateShipment = sanitizer($_POST['date-shipment']);
    $dateArrival = sanitizer($_POST['date-arrival']);

    // SENDER'S INFO
    $senderName = sanitizer($_POST['sender-name']);
    $senderEmail = sanitizer($_POST['sender-email']);
    $senderAddress = sanitizer($_POST['sender-address']);

    // RECEIVER'S INFO
    $receiverName = sanitizer($_POST['receiver-name']);
    $receiverEmail = sanitizer($_POST['receiver-email']);
    $receiverAddress = sanitizer($_POST['receiver-address']);

    // PAYMENT
    $amount = sanitizer($_POST['amount']);
    $currencyCode = sanitizer($_POST['currency-code']);
    $payOnDelivery = sanitizer($_POST['payment-on-delivery']);

    // CHECK FOR REQUIRED FIELDS
    if (
      !$id ||
      !$title ||
      !$dateArrival ||
      !$dateShipment ||
      !$senderName ||
      !$receiverName
    ) throw new Exception("All fields marked with (*) are required.");


    $query = "INSERT INTO `parcel`(`id`, `title`, `weight`, `size`, `from`, `to`, `date_shipment`, `date_arrival`, `sender_name`, `sender_email`, `sender_address`, `receiver_name`, `receiver_email`, `receiver_address`, `amount`, `currency_code`, `pay_on_delivery`) VALUES (:id, :title, :weight, :size, :from, :to, :dateShipment, :dateArrival, :senderName, :senderEmail, :senderAddress, :receiverName, :receiverEmail, :receiverAddress, :amount, :currencyCode, :payOnDelivery)";
    $result = $connect->prepare($query);
    $result->execute([
      "id" => $id,
      "title" => $title,
      "weight" => $weight,
      "size" => $size,
      "from" => $from,
      "to" => $to,
      "dateShipment" => $dateShipment,
      "dateArrival" => $dateArrival,
      "senderName" => $senderName,
      "senderEmail" => $senderEmail,
      "senderAddress" => $senderAddress,
      "receiverName" => $receiverName,
      "receiverEmail" => $receiverEmail,
      "receiverAddress" => $receiverAddress,
      "amount" => $amount,
      "currencyCode" => $currencyCode,
      "payOnDelivery" => $payOnDelivery,
    ]);

    // CHECK IF SUCCESSFULL
    if (!$result->rowCount()) throw new Exception("Failed to update parcel [SHIPMENT]");

    setAlert("Parcel added!", "success");
    redirect("../view-parcel");
  } catch (Exception $e) {
    setAlert($e->getMessage());
    redirect($_SERVER['HTTP_REFERER'] ?? "../create-parcel");
  }
  exit();
} 

else if (isset($_POST['edit-parcel'])) {
  // PARCEL INFO
  $title = sanitizer($_POST['title']);
  $weight = sanitizer($_POST['weight']);
  $size = sanitizer($_POST['size']);
  $from = sanitizer($_POST['from']);
  $to = sanitizer($_POST['to']);
  $dateShipment = sanitizer($_POST['date-shipment']);
  $dateArrival = sanitizer($_POST['date-arrival']);

  // SENDER'S INFO
  $senderName = sanitizer($_POST['sender-name']);
  $senderEmail = sanitizer($_POST['sender-email']);
  $senderAddress = sanitizer($_POST['sender-address']);

  // RECEIVER'S INFO
  $receiverName = sanitizer($_POST['receiver-name']);
  $receiverEmail = sanitizer($_POST['receiver-email']);
  $receiverAddress = sanitizer($_POST['receiver-address']);

  // PAYMENT
  $amount = sanitizer($_POST['amount']);
  $currencyCode = sanitizer($_POST['currency-code']);
  $payOnDelivery = sanitizer($_POST['payment-on-delivery']);
  $editId = $_POST['edit-parcel'];


  try {
    $query = "UPDATE `parcel` 
      SET 
      `title` = :title, 
      `weight` = :weight, 
      `size` = :size, 
      `from` = :from, 
      `to` = :to, 
      `date_shipment` = :dateShipment, 
      `date_arrival` = :dateArrival, 
      `sender_name` = :senderName, 
      `sender_email` = :senderEmail, 
      `sender_address` = :senderAddress, 
      `receiver_name` = :receiverName, 
      `receiver_email` = :receiverEmail, 
      `receiver_address` = :receiverAddress, 
      `amount` = :amount, 
      `currency_code` = :currencyCode, 
      `pay_on_delivery` = :payOnDelivery
      WHERE `id` = :editId";
    $result = $connect->prepare($query);
    $result->execute([
      "title" => $title,
      "weight" => $weight,
      "size" => $size,
      "from" => $from,
      "to" => $to,
      "dateShipment" => $dateShipment,
      "dateArrival" => $dateArrival,
      "senderName" => $senderName,
      "senderEmail" => $senderEmail,
      "senderAddress" => $senderAddress,
      "receiverName" => $receiverName,
      "receiverEmail" => $receiverEmail,
      "receiverAddress" => $receiverAddress,
      "amount" => $amount,
      "currencyCode" => $currencyCode,
      "payOnDelivery" => $payOnDelivery,
      "editId" => $editId,
    ]);

    if (!$result->rowCount()) throw new Exception("Failed to edit parcel [PARCEL]");

    setAlert("Parcel updated!", "success");
    redirect("../view-parcel");
  } catch (Exception $e) {
    setAlert($e->getMessage());
    redirect($_SERVER['HTTP_REFERER'] ?? "../edit-parcel?parcel_id=$editId");
  }
  exit();
} 

else if (isset($_POST['delete-parcel'])) {
  $id = $_POST['delete-parcel'];
  try {
    $result = $connect->prepare("DELETE FROM parcel WHERE id = ?");
    $result->execute([$id]);

    if (!$result->rowCount()) throw new Exception("Failed to delete parcel");
    setAlert("Parcel deleted!", "success");
    redirect($_SERVER['HTTP_REFERER'] ?? "../view-parcel");
  } catch (Exception $e) {
    setAlert($e->getMessage());
    redirect($_SERVER['HTTP_REFERER'] ?? "../view-parcel");
  }
  exit();
} 

else if (isset($_GET['claim-parcel'])) {
  $id = $_GET['claim-parcel'];
  try {
    $result = $connect->prepare("UPDATE parcel SET status = 'claimed' WHERE id = ?");
    $result->execute([$id]);

    if (!$result->rowCount()) throw new Exception("Failed to update parcel");
    setAlert("Parcel updated!", "success");
    redirect($_SERVER['HTTP_REFERER'] ?? "../view-parcel");
  } catch (Exception $e) {
    setAlert($e->getMessage());
    redirect($_SERVER['HTTP_REFERER'] ?? "../view-parcel");
  }
  exit();
} 

else if (isset($_GET['unclaim-parcel'])) {
  $id = $_GET['unclaim-parcel'];
  try {
    $result = $connect->prepare("UPDATE parcel SET status = 'Not claimed' WHERE id = ?");
    $result->execute([$id]);

    if (!$result->rowCount()) throw new Exception("Failed to update parcel");
    setAlert("Parcel updated!", "success");
    redirect($_SERVER['HTTP_REFERER'] ?? "../view-parcel");
  } catch (Exception $e) {
    setAlert($e->getMessage());
    redirect($_SERVER['HTTP_REFERER'] ?? "../view-parcel");
  }
  exit();
} 

else {
  redirect($_SERVER['HTTP_REFERER'] ?? "../view-parcel");
  exit();
}
