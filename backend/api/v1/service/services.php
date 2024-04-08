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
 * Ottieni tutte le categorie dal database.
 *
 * @return array Le categorie.
 */
function getCategories()
{
    global $db;

    $query = $db->prepare("SELECT * FROM categories");
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}

/**
 * Ottieni tutti i tipi dal database.
 *
 * @return array I tipi.
 */
function getTypes()
{
    global $db;

    $query = $db->prepare("SELECT * FROM types");
    $query->execute();
    $types = $query->fetchAll(PDO::FETCH_ASSOC);

    return $types;
}

/**
 * Ottieni i servizi per un determinato tipo dal database.
 *
 * @param int $typeId L'ID del tipo.
 * @return array I servizi per il tipo.
 */
function getServicesByType($typeId)
{
    global $db;

    $query = $db->prepare("SELECT services.id, services.name, services.price FROM services
                            INNER JOIN services_types ON services.id = services_types.service_id
                            WHERE services_types.type_id = :type_id");
    $query->bindParam(':type_id', $typeId, PDO::PARAM_INT);
    $query->execute();
    $services = $query->fetchAll(PDO::FETCH_ASSOC);
    return $services;
}

/**
 * Ottieni tutti i servizi dal database.
 *
 * @return array I servizi.
 */
function getServices()
{
    global $db;

    $query = $db->prepare("SELECT id, name, price FROM services");
    $query->execute();
    $services = $query->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}

// Gestione delle richieste
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
} else {
    echo createResponse('error', 'Invalid request method.', []);
}