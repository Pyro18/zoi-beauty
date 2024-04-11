<?php
// Includi i file di configurazione del database e delle richieste
include '../../../config/db.php';
include '../../../config/request_db.php';

/**
 * Crea una risposta JSON.
 *
 * @param string $status Lo stato della risposta.
 * @param string $message Il messaggio della risposta.
 * @param mixed $data I dati della risposta.
 * @return string La risposta JSON.
 */
function createResponse($status, $message, $data = null)
{
    return json_encode(array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    ));
}

/**
 * Ottieni tutte le prenotazioni dal database.
 *
 * @return array Le prenotazioni.
 */
function getBookings()
{
    global $db;

    $query = $db->prepare("SELECT * FROM prenotazioni");
    $query->execute();
    $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

    return $bookings;
}

/**
 * Effettua una prenotazione.
 *
 * @param int $serviceId L'ID del servizio prenotato.
 * @param int $userId L'ID dell'utente che effettua la prenotazione.
 * @param string $dateTime La data e l'ora della prenotazione.
 * @return bool True se la prenotazione è stata effettuata con successo, altrimenti false.
 */
function bookService($serviceId, $userId, $dateTime)
{
    global $db;

    $query = $db->prepare("INSERT INTO prenotazioni (utente_id, servizio_id, data_ora) VALUES (:utente_id, :servizio_id, :data_ora)");
    $query->bindParam(':utente_id', $userId, PDO::PARAM_INT);
    $query->bindParam(':servizio_id', $serviceId, PDO::PARAM_INT);
    $query->bindParam(':data_ora', $dateTime);
    return $query->execute();
}

// Gestione delle richieste
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Implementazione per ottenere le categorie, i tipi e i servizi rimane invariata
    $categories = getCategories();
    $types = getTypes();

    // Aggiungi la categoria "Tutti" all'inizio dell'array delle categorie
    array_unshift($categories, array('id' => 0, 'name' => 'Tutti'));

    // Se viene fornito un tipo di ID nella query string, ottieni i servizi per quel tipo
    if (isset($_GET['type_id'])) {
        $typeId = $_GET['type_id'];
        $services = getServicesByType($typeId);
    } else {
        // Altrimenti, ottieni tutti i servizi
        $services = getServices();
    }

    $data = array(
        'categories' => $categories,
        'types' => $types,
        'services' => $services
    );

    echo createResponse('success', 'Data fetched successfully.', $data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica che siano stati forniti i parametri necessari per effettuare la prenotazione
    if (isset($_POST['service_id']) && isset($_POST['user_id']) && isset($_POST['date_time'])) {
        $serviceId = $_POST['service_id'];
        $userId = $_POST['user_id'];
        $dateTime = $_POST['date_time'];

        // Effettua la prenotazione
        if (bookService($serviceId, $userId, $dateTime)) {
            echo createResponse('success', 'Booking successful.');
        } else {
            echo createResponse('error', 'Failed to book the service.');
        }
    } else {
        echo createResponse('error', 'Missing parameters for booking.');
    }
} else {
    echo createResponse('error', 'Invalid request method.', []);
}
