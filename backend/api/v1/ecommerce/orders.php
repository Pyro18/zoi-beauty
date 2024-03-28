<?php

// Funzione per creare una risposta JSON
function createResponse($status, $message, $data = null)
{
    return json_encode(array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    ));
}

// Visualizza tutti gli ordini di un utente
function getUserOrders($user_id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM orders WHERE user_id = :user_id");
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    $orders = $query->fetchAll(PDO::FETCH_ASSOC);

    // Per ogni ordine, recupera gli articoli associati
    foreach ($orders as &$order) {
        $order_id = $order['order_id'];
        $query = $db->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $query->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $query->execute();
        $items = $query->fetchAll(PDO::FETCH_ASSOC);
        $order['items'] = $items;
    }

    return createResponse('success', 'Orders fetched successfully.', $orders);
}

// Aggiungi un nuovo ordine
function addOrder($user_id, $total_amount, $payment_method, $items)
{
    global $db;
    $db->beginTransaction();

    try {
        // Inserisci l'ordine nella tabella degli ordini
        $query = $db->prepare("INSERT INTO orders (user_id, total_amount, payment_method) VALUES (:user_id, :total_amount, :payment_method)");
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
        $query->bindParam(':payment_method', $payment_method, PDO::PARAM_STR);
        $query->execute();
        $order_id = $db->lastInsertId();

        // Inserisci gli articoli dell'ordine nella tabella degli order_items
        foreach ($items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $query = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
            $query->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $query->execute();
        }

        $db->commit();
        return createResponse('success', 'Order placed successfully.', ['order_id' => $order_id]);
    } catch (PDOException $e) {
        $db->rollBack();
        return createResponse('error', 'Failed to place order.');
    }
}

// Cancella un ordine
function cancelOrder($order_id)
{
    global $db;
    $query = $db->prepare("DELETE FROM orders WHERE order_id = :order_id");
    $query->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $query->execute();

    return createResponse('success', 'Order canceled successfully.');
}

// Modifica la quantità di un articolo nell'ordine
function updateOrderItemQuantity($order_id, $product_id, $quantity)
{
    global $db;
    $query = $db->prepare("UPDATE order_items SET quantity = :quantity WHERE order_id = :order_id AND product_id = :product_id");
    $query->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $query->execute();

    return createResponse('success', 'Order item quantity updated successfully.');
}

// Gestione delle richieste
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        echo getUserOrders($user_id);
    } else {
        echo createResponse('error', 'User ID is required.');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        if (isset($data['user_id'], $data['total_amount'], $data['payment_method'], $data['items'])) {
            $user_id = $data['user_id'];
            $total_amount = $data['total_amount'];
            $payment_method = $data['payment_method'];
            $items = $data['items'];
            echo addOrder($user_id, $total_amount, $payment_method, $items);
        } else {
            echo createResponse('error', 'Missing required fields.');
        }
    } else {
        echo createResponse('error', 'Invalid request.');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents('php://input'), $delete_vars);
    if (isset($delete_vars['order_id'])) {
        $order_id = $delete_vars['order_id'];
        echo cancelOrder($order_id);
    } else {
        echo createResponse('error', 'Order ID is required (delete).');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents('php://input'), $put_vars);
    if (isset($put_vars['order_id'], $put_vars['product_id'], $put_vars['quantity'])) {
        $order_id = $put_vars['order_id'];
        $product_id = $put_vars['product_id'];
        $quantity = $put_vars['quantity'];
        echo updateOrderItemQuantity($order_id, $product_id, $quantity);
    } else {
        echo createResponse('error', 'Order ID, product ID, and quantity are required.');
    }
}

