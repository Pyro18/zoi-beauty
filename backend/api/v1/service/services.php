<?php
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

function getServices($typeId = null)
{
    global $db;

    if ($typeId !== null) {
        $query = $db->prepare("
            SELECT s.* 
            FROM services s
            INNER JOIN services_types st ON s.id = st.service_id
            WHERE st.type_id = :type_id
        ");
        $query->bindParam(':type_id', $typeId, PDO::PARAM_INT);
    } else {
        $query = $db->prepare("SELECT * FROM services");
    }

    $query->execute();
    $services = $query->fetchAll(PDO::FETCH_ASSOC);

    return createResponse('success', 'Services fetched successfully.', $services);
}


// Gestione delle richieste
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo getServices();
} else {
    echo createResponse('error', 'Invalid request method.', []);
}
