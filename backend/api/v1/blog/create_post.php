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

// Funzione per inserire un nuovo post
function createPost($title, $content, $author_id)
{
    global $db;
    $query = $db->prepare("INSERT INTO posts (title, content, author_id) VALUES (:title, :content, :author_id)");
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return createResponse('success', 'Post added successfully.', $result);
}

// Gestione delle richieste
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        if (isset($data['action']) && $data['action'] === 'create_post' &&
            isset($data['title'], $data['content'], $data['author_id'])) {
            $title = $data['title'];
            $content = $data['content'];
            $author_id = $data['author_id'];
            echo createPost($title, $content, $author_id);
        } else {
            echo createResponse('error', 'Missing required fields or invalid action.');
        }
    } else {
        echo createResponse('error', 'Invalid request.');
    }
} else {
    echo createResponse('error', 'Invalid request method.');
}
