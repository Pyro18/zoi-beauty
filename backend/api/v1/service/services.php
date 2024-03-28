<?php

function createResponse($status, $message, $data = null)
{
    return json_encode(array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    ));
}

// Funzione per recuperare tutti i servizi
function getServices()
{
    global $db;
    $query = $db->prepare("SELECT * FROM services");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return createResponse('success', 'Services fetched successfully.', $result);
}

// Funzione per recuperare tutti i tipi
function getTypes()
{
    global $db;
    $query = $db->prepare("SELECT * FROM types");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return createResponse('success', 'Types fetched successfully.', $result);
}

// Funzione per recuperare tutte le categorie
function getCategories()
{
    global $db;
    $query = $db->prepare("SELECT * FROM categories");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return createResponse('success', 'Categories fetched successfully.', $result);
}

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] === 'get_services') {
        echo getServices();
    } elseif ($_REQUEST['action'] === 'get_types') {
        echo getTypes();
    } elseif ($_REQUEST['action'] === 'get_categories') {
        echo getCategories();
    }
} else {
    echo createResponse('error', 'Action is required.');
}