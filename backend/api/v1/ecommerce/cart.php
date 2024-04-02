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

// Funzione per gestire la richiesta di aggiunta di un prodotto al carrello
function addToCart($user_id, $product_id, $quantity)
{
    global $db;
    $query = $db->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $query->execute();

    // Recupera l'elemento del carrello appena aggiunto
    $cart_item_id = $db->lastInsertId();
    $query = $db->prepare("SELECT * FROM cart_items WHERE cart_item_id = :cart_item_id");
    $query->bindParam(':cart_item_id', $cart_item_id, PDO::PARAM_INT);
    $query->execute();
    $cart_item = $query->fetch(PDO::FETCH_ASSOC);

    return createResponse('success', 'Product added to cart successfully.', $cart_item);
}

// Funzione per gestire la richiesta di ottenere tutti gli elementi nel carrello
function getCartItems($user_id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM cart_items WHERE user_id = :user_id");
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return createResponse('success', 'Cart items fetched successfully.', $result);
}

// Funzione per gestire la richiesta di rimozione di un prodotto dal carrello
function removeFromCart($cart_item_id)
{
    global $db;
    $query = $db->prepare("DELETE FROM cart_items WHERE cart_item_id = :cart_item_id");
    $query->bindParam(':cart_item_id', $cart_item_id, PDO::PARAM_INT);
    $query->execute();

    return createResponse('success', 'Product removed from cart successfully.');
}

// Controlla il metodo della richiesta HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($requestData['action'])) {
        if ($requestData['action'] === 'add_to_cart') {
            echo addToCart($requestData['user_id'], $requestData['product_id'], $requestData['quantity']);
        } elseif ($requestData['action'] === 'remove_from_cart') {
            echo removeFromCart($requestData['cart_item_id']);
        }
    } else {
        echo createResponse('error', 'Action is missing in the request.', []);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'get_cart_items' && isset($_GET['user_id'])) {
        echo getCartItems($_GET['user_id']);
    } else {
        echo createResponse('error', 'Action or user ID is missing in the request.', []);
    }
}
