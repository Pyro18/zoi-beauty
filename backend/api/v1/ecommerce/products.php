<?php
include '../../../config/db.php';
include '../../../config/request_db.php';
// Funzione per creare una risposta JSON
function createResponse($status, $message, $data = null)
{
    return json_encode(array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    ));
}

// Funzione per recuperare tutti i prodotti
function getProducts()
{
    global $db;
    $query = $db->prepare("SELECT * FROM products");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return createResponse('success', 'Products fetched successfully.', $result);
}

// Funzione per recuperare un singolo prodotto dato il suo ID
function getProduct($product_id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM products WHERE product_id = :product_id");
    $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return createResponse('success', 'Product fetched successfully.', $result);
}

// Funzione per inserire un nuovo prodotto
function addProduct($name, $description, $price, $stock_quantity)
{
    global $db;
    $query = $db->prepare("INSERT INTO products (name, price, description, stock_quantity) VALUES (:name, :price, :description, :stock_quantity)");
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':stock_quantity', $stock_quantity, PDO::PARAM_INT);
    $query->execute();

    return createResponse('success', 'Product added successfully.');
}

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] === 'get_products') {
        echo getProducts();
    } elseif ($_REQUEST['action'] === 'get_product' && isset($_REQUEST['product_id'])) {
        $product_id = $_REQUEST['product_id'];
        echo getProduct($product_id);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['action'])) {
        if ($data['action'] === 'add_product' && isset($data['name'], $data['description'], $data['price'], $data['stock_quantity'])) {
            $name = $data['name'];
            $description = $data['description'];
            $price = $data['price'];
            $stock_quantity = $data['stock_quantity'];
            echo addProduct($name, $description, $price, $stock_quantity);
        }
    } else {
        echo createResponse('error', 'Missing action field.');
    }
} else {
    echo createResponse('error', 'Action or product ID is required.');
}

