<?php
global $db;
session_start();
include "../../../config/db.php";
include "../../../config/request_db.php";

function createResponse($status, $message, $data = null)
{
    return json_encode([
        "status" => $status,
        "message" => $message,
        "data" => $data,
    ]);
}

function getBooking($bookingId)
{
    global $db;

    $query = $db->prepare("SELECT * FROM prenotazioni WHERE id = :booking_id");
    $query->bindParam(":booking_id", $bookingId, PDO::PARAM_INT);
    $query->execute();
    $booking = $query->fetch(PDO::FETCH_ASSOC);

    return $booking;
}

function getAllBookings()
{
    global $db;
    $query = $db->prepare(
        "SELECT prenotazioni.*, services.name AS servizio_nome FROM prenotazioni JOIN services ON prenotazioni.servizio_id = services.id"
    );
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function createBooking($serviceId, $userId, $dateTime)
{
    global $db;

    $query = $db->prepare(
        "INSERT INTO prenotazioni (utente_id, servizio_id, data_ora) VALUES (:utente_id, :servizio_id, :data_ora)"
    );
    $query->bindParam(":utente_id", $userId, PDO::PARAM_INT);
    $query->bindParam(":servizio_id", $serviceId, PDO::PARAM_INT);
    $query->bindParam(":data_ora", $dateTime);
    return $query->execute();

    //if ($result) {
    //    $to = "email";
    //    $subject = "Prenotazione effettuata";
    //    $message = "Grazie per aver effettuato una prenotazione. \n\nDettagli della prenotazione:\nServizio ID: $serviceId\nData e ora: $dateTime";
    //    $headers = "From: noreply@";
    //    mail($to, $subject, $message, $headers);
    //}
    //return $result;
}

function updateBooking($bookingId, $dateTime)
{
    global $db;

    $query = $db->prepare(
        "UPDATE prenotazioni SET data_ora = :data_ora WHERE id = :booking_id"
    );
    $query->bindParam(":data_ora", $dateTime);
    $query->bindParam(":booking_id", $bookingId, PDO::PARAM_INT);
    return $query->execute();
}

function deleteBooking($bookingId)
{
    global $db;

    $query = $db->prepare("DELETE FROM prenotazioni WHERE id = :booking_id");
    $query->bindParam(":booking_id", $bookingId, PDO::PARAM_INT);
    return $query->execute();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestData = json_decode(file_get_contents("php://input"), true);

switch ($requestMethod) {
    case "GET":
        if (isset($_GET["id"])) {
            $booking = getBooking($_GET["id"]);
            if ($booking) {
                echo createResponse(
                    "success",
                    "Booking fetched successfully.",
                    [$booking]
                );
            } else {
                http_response_code(404);
                echo createResponse("error", "Missing required data.", []);
            }
        } elseif (isset($_GET["user_id"])) {
            // Altrimenti, restituisci tutte le prenotazioni per un utente specifico
            $bookings = getAllBookings($_GET["user_id"]);
            echo createResponse(
                "success",
                "Booking fetched successfully.",
                $bookings
            );
        } else {
            http_response_code(400);
            echo createResponse("error", "Missing user_id parameter.", []);
        }
        break;

    case "POST":
        if (
            !isset($requestData["servizio_id"]) ||
            !isset($requestData["utente_id"]) ||
            !isset($requestData["data_ora"])
        ) {
            echo createResponse("error", "Missing required data.");
            exit();
        }

        $serviceId = $requestData["servizio_id"];
        $userId = $requestData["utente_id"];
        $dateTime = $requestData["data_ora"];

        if (createBooking($serviceId, $userId, $dateTime)) {
            echo createResponse("success", "Booking created successfully.");
        } else {
            echo createResponse("error", "Failed to create booking.");
        }
        break;

    case "PUT":
        if (
            !isset($requestData["booking_id"]) ||
            !isset($requestData["data_ora"])
        ) {
            echo createResponse("error", "Missing required data.");
            exit();
        }

        $bookingId = $requestData["booking_id"];
        $dateTime = $requestData["data_ora"];

        if (updateBooking($bookingId, $dateTime)) {
            echo createResponse("success", "Booking updated successfully.");
        } else {
            echo createResponse("error", "Failed to update booking.");
        }
        break;

    case "DELETE":
        $bookingId = $_GET["booking_id"] ?? null;

        if ($bookingId === null) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "ID del booking non fornito",
            ]);
            exit();
        }

        $result = deleteBooking($bookingId);

        if ($result) {
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Booking eliminato con successo",
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => 'Errore durante l\'eliminazione del booking',
            ]);
        }
        break;

    default:
        echo createResponse("error", "Invalid request method.", []);
        break;
}