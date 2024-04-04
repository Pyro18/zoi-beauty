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

// Function to fetch all services
function getServices()
{
    global $db;
    $query = $db->prepare("SELECT services.*, types.id as type_id FROM services JOIN services_types ON services.id = services_types.service_id JOIN types ON services_types.type_id = types.id");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// Function to fetch all types
function getTypes()
{
    global $db;
    $query = $db->prepare("SELECT types.*, services.id as service_id, categories.id as category_id FROM types JOIN services_types ON types.id = services_types.type_id JOIN services ON services_types.service_id = services.id JOIN categories_types ON types.id = categories_types.type_id JOIN categories ON categories_types.category_id = categories.id");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// Function to fetch all categories
function getCategories()
{
    global $db;
    $query = $db->prepare("SELECT categories.*, types.id as type_id FROM categories JOIN categories_types ON categories.id = categories_types.category_id JOIN types ON categories_types.type_id = types.id");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// Fetch all services, types, and categories and return them in a JSON response
$services = getServices();
$types = getTypes();
$categories = getCategories();

echo json_encode(array(
    'services' => $services,
    'types' => $types,
    'categories' => $categories
));