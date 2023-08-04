<?php


function listAllParcels()
{
  global $connect;
  try {
    $result = $connect->query("SELECT * FROM parcel");
    $result->execute();
    return $result->fetchAll();
  } catch (Exception $e) {
    setAlert($e->getMessage());
    return [];
  }
}

function listUndeliveredParcels()
{
  global $connect;
  try {
    $result = $connect->query("SELECT * FROM parcel WHERE status LIKE 'not claimed'");
    $result->execute();
    return $result->fetchAll();
  } catch (Exception $e) {
    setAlert($e->getMessage());
    return [];
  }
}

function listDeliveredParcels()
{
  global $connect;
  try {
    $result = $connect->query("SELECT * FROM parcel WHERE status LIKE 'claimed'");
    $result->execute();
    return $result->fetchAll();
  } catch (Exception $e) {
    setAlert($e->getMessage());
    return [];
  }
}

function listFewParcels()
{
  global $connect;
  try {
    $result = $connect->query("SELECT * FROM parcel ORDER BY date DESC LIMIT 5");
    $result->execute();
    return $result->fetchAll();
  } catch (Exception $e) {
    setAlert($e->getMessage());
    return [];
  }
}

function getParcel(string $id)
{
  global $connect;
  try {
    $result = $connect->prepare("SELECT * FROM parcel WHERE id = ?");
    $result->execute([$id]);
    return $result->fetch();
  } catch (Exception $e) {
    setAlert($e->getMessage());
    return [];
  }
}

function getSearchParcel(string $search)
{
  global $connect;
  try {
    $result = $connect->prepare("SELECT * FROM parcel WHERE title REGEXP ? OR id REGEXP ?");
    $result->execute([$search, $search]);
    return $result->fetchAll();
  } catch (Exception $e) {
    setAlert($e->getMessage());
    return [];
  }
}
