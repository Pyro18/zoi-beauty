<?php
session_start();
include '../../../config/db.php';
include '../../../config/request_db.php';

function createResponse($status, $message, $data = null)
{
    return json_encode(array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    ));
}


function getBooking($bookingId)
{
    global $db;

    $query = $db->prepare("SELECT * FROM prenotazioni WHERE id = :booking_id");
    $query->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
    $query->execute();
    $booking = $query->fetch(PDO::FETCH_ASSOC);

    return $booking;
}

function getAllBookings()
{
    global $db;

    $query = $db->prepare("SELECT * FROM prenotazioni");
    $query->execute();
    $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

    return $bookings;
}

function createBooking($serviceId, $userId, $dateTime)
{
    global $db;

    $query = $db->prepare("INSERT INTO prenotazioni (utente_id, servizio_id, data_ora) VALUES (:utente_id, :servizio_id, :data_ora)");
    $query->bindParam(':utente_id', $userId, PDO::PARAM_INT);
    $query->bindParam(':servizio_id', $serviceId, PDO::PARAM_INT);
    $query->bindParam(':data_ora', $dateTime);
    return $query->execute();
}

function updateBooking($bookingId, $serviceId, $userId, $dateTime)
{
    global $db;

    $query = $db->prepare("UPDATE prenotazioni SET utente_id = :utente_id, servizio_id = :servizio_id, data_ora = :data_ora WHERE id = :booking_id");
    $query->bindParam(':utente_id', $userId, PDO::PARAM_INT);
    $query->bindParam(':servizio_id', $serviceId, PDO::PARAM_INT);
    $query->bindParam(':data_ora', $dateTime);
    $query->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
    return $query->execute();
}

function deleteBooking($bookingId)
{
    global $db;

    $query = $db->prepare("DELETE FROM prenotazioni WHERE id = :booking_id");
    $query->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
    return $query->execute();
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestData = json_decode(file_get_contents('php://input'), true);

switch ($requestMethod) {
    case 'GET':
        if (isset($requestData['booking_id'])) {
            $bookingId = $requestData['booking_id'];
            $booking = getBooking($bookingId);

            if ($booking) {
                echo createResponse('success', 'Booking fetched successfully.', $booking);
            } else {
                echo createResponse('error', 'Booking not found.', []);
            }
        } else {
            $bookings = getAllBookings();
            echo createResponse('success', 'Bookings fetched successfully.', $bookings);
        }
        break;

    case 'POST':
    if (!isset($requestData['servizio_id']) || !isset($requestData['utente_id']) || !isset($requestData['data_ora'])) {
        echo createResponse('error', 'Missing required data.');
        exit;
    }

    $serviceId = $requestData['servizio_id'];
    $userId = $requestData['utente_id'];
    $dateTime = $requestData['data_ora'];

    if (createBooking($serviceId, $userId, $dateTime)) {
        echo createResponse('success', 'Booking created successfully.');
    } else {
        echo createResponse('error', 'Failed to create booking.');
    }
    break;

case 'PUT':
    if (!isset($requestData['booking_id']) || !isset($requestData['servizio_id']) || !isset($requestData['utente_id']) || !isset($requestData['data_ora'])) {
        echo createResponse('error', 'Missing required data.');
        exit;
    }

    $bookingId = $requestData['booking_id'];
    $serviceId = $requestData['servizio_id'];
    $userId = $requestData['utente_id'];
    $dateTime = $requestData['data_ora'];

    if (updateBooking($bookingId, $serviceId, $userId, $dateTime)) {
        echo createResponse('success', 'Booking updated successfully.');
    } else {
        echo createResponse('error', 'Failed to update booking.');
    }
    break;

    case 'DELETE':
        $bookingId = $requestData['booking_id'];

        if (deleteBooking($bookingId)) {
            echo createResponse('success', 'Booking deleted successfully.');
        } else {
            echo createResponse('error', 'Failed to delete booking.');
        }
        break;

    default:
        echo createResponse('error', 'Invalid request method.', []);
        break;
}