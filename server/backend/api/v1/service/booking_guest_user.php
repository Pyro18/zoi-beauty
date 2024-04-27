<?php
session_start();
include '../../../config/db.php';
include '../../../config/request_db.php';

function createResponse($status, $message, $data = null)
{
  return json_encode([
    'status' => $status,
    'message' => $message,
    'data' => $data
  ]);
}

function getGuestBooking($bookingId)
{
  global $db;
  $query = $db->prepare("SELECT * FROM prenotazioni_non_utenti WHERE id = :booking_id");
  $query->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
  $query->execute();
  $booking = $query->fetch(PDO::FETCH_ASSOC);
  return $booking;
}

function getAllGuestBookings()
{
  global $db;
  $query = $db->prepare("SELECT * FROM prenotazioni_non_utenti");
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function createGuestBooking($nome, $cognome, $telefono, $email, $data_ora, $servizio_id)
{
  global $db;
  $query = $db->prepare("INSERT INTO prenotazioni_non_utenti (nome, cognome, telefono, email, data_ora, servizio_id) VALUES (:nome, :cognome, :telefono, :email, :data_ora, :servizio_id)");
  $query->bindParam(':nome', $nome);
  $query->bindParam(':cognome', $cognome);
  $query->bindParam(':telefono', $telefono);
  $query->bindParam(':email', $email);
  $query->bindParam(':data_ora', $data_ora);
  $query->bindParam(':servizio_id', $servizio_id, PDO::PARAM_INT);
  return $query->execute();
}

function updateGuestBooking($bookingId, $dateTime)
{
  global $db;
  $query = $db->prepare("UPDATE prenotazioni_non_utenti SET data_ora = :data_ora WHERE id = :booking_id");
  $query->bindParam(':data_ora', $dateTime);
  $query->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
  return $query->execute();
}

function deleteGuestBooking($bookingId)
{
  global $db;
  $query = $db->prepare("DELETE FROM prenotazioni_non_utenti WHERE id = :booking_id");
  $query->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
  return $query->execute();
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestData = json_decode(file_get_contents('php://input'), true);

switch ($requestMethod) {
  case 'GET':
    if (isset($_GET['bookingId'])) {
      $bookingId = $_GET['bookingId'];
      $booking = getGuestBooking($bookingId);
      if ($booking) {
        echo createResponse('success', 'Guest booking found', $booking);
      } else {
        echo createResponse('error', 'Guest booking not found');
      }
    } else {
      $bookings = getAllGuestBookings();
      echo createResponse('success', 'All guest bookings', $bookings);
    }
    break;
  case 'POST':
    $nome = $requestData['nome'];
    $cognome = $requestData['cognome'];
    $telefono = $requestData['telefono'];
    $email = $requestData['email'];
    $data_ora = $requestData['data_ora'];
    $servizio_id = $requestData['servizio_id'];
    $success = createGuestBooking($nome, $cognome, $telefono, $email, $data_ora, $servizio_id);
    if ($success) {
      echo createResponse('success', 'Guest booking created');
    } else {
      echo createResponse('error', 'Failed to create guest booking');
    }
    break;
  case 'PUT':
    if (isset($_GET['bookingId'])) {
      $bookingId = $_GET['bookingId'];
      $dateTime = $requestData['data_ora'];
      $success = updateGuestBooking($bookingId, $dateTime);
      if ($success) {
        echo createResponse('success', 'Guest booking updated');
      } else {
        echo createResponse('error', 'Failed to update guest booking');
      }
    } else {
      echo createResponse('error', 'Missing booking ID');
    }
    break;
  case 'DELETE':
    if (isset($_GET['bookingId'])) {
      $bookingId = $_GET['bookingId'];
      $success = deleteGuestBooking($bookingId);
      if ($success) {
        echo createResponse('success', 'Guest booking deleted');
      } else {
        echo createResponse('error', 'Failed to delete guest booking');
      }
    } else {
      echo createResponse('error', 'Missing booking ID');
    }
    break;
  default:
    echo createResponse('error', 'Invalid request method');
    break;
}
