<?php
session_start();

include '../../../config/db.php';
include '../../../config/request_db.php';

function createResponse($status, $message, $data = null)
{
	return json_encode([
		'status' => $status,
		'message' => $message,
		'data' => $data
	]);
}

function getAllUsers()
{
	global $db;

	$sql = "SELECT id, username, nome, cognome, telefono, email FROM utenti";
	$query = $db->prepare($sql);
	$query->execute();
	$users = $query->fetchAll(PDO::FETCH_ASSOC);

	return $users;

}



// Quando crei un nuovo utente
function createUser($username, $nome, $cognome, $telefono, $email)
{
    global $db;

    $pfp = getRandomProfilePicture();

    $sql = "INSERT INTO utenti (username, nome, cognome, telefono, email, pfp) VALUES (:username, :nome, :cognome, :telefono, :email, :pfp)";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':nome', $nome, PDO::PARAM_STR);
    $query->bindParam(':cognome', $cognome, PDO::PARAM_STR);
    $query->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':pfp', $pfp, PDO::PARAM_STR);
    $query->execute();
}


function getUser($userId)
{
	global $db;

	$sql = "SELECT id, username, nome, cognome, telefono, email FROM utenti WHERE id = :userId";
	$query = $db->prepare($sql);
	$query->bindParam(':userId', $userId, PDO::PARAM_INT);
	$query->execute();
	$user = $query->fetch(PDO::FETCH_ASSOC);

	return $user;
}

function liveSearch($q)
{
	global $db;
	$sql = "SELECT id, username, nome, cognome, telefono, email FROM utenti WHERE nome LIKE :q OR cognome LIKE :q OR telefono LIKE :q OR email LIKE :q";
	$query = $db->prepare($sql);
	$query->bindValue(':q', '%' . $q . '%', PDO::PARAM_STR);
	$query->execute();
	$users = $query->fetchAll(PDO::FETCH_ASSOC);
	return $users;
}

function pfp($userId)
{
	global $db;
	$sql = "SELECT id, pfp FROM utenti WHERE id = :userId";
	$query = $db->prepare($sql);
	$query->bindParam(':userId', $userId, PDO::PARAM_INT);
	$query->execute();
	$pfp = $query->fetch(PDO::FETCH_ASSOC);
	return $pfp;
}

function getRandomProfilePicture()
{
    $dir = '../../../frontend/assets/images/profile';
    $files = glob($dir . '/*.*');
    $file = array_rand($files);
    return $files[$file];
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['user_id'])) {
		$userId = $_GET['user_id'];
		$user = getUser($userId);
        $pfp = pfp($userId);

		if ($user) {
            $user['pfp'] = $pfp['pfp'];
			echo createResponse('success', 'User fetched successfully.', $user);
		} else {
			echo createResponse('error', 'User not found.', []);
		}
	} elseif (isset($_GET['q'])) {
		$q = $_GET['q'];
		$users = liveSearch($q);
		if ($users) {
			echo createResponse('success', 'Users fetched successfully.', $users);
		} else {
			echo createResponse('error', 'No users found.', []);
		}
	} else {
		$users = getAllUsers();
		if ($users) {
			echo createResponse('success', 'Users fetched successfully.', $users);
		} else {
			echo createResponse('error', 'No users found.', []);
		}
	}
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $nome = $data['nome'];
    $cognome = $data['cognome'];
    $telefono = $data['telefono'];
    $email = $data['email'];

    createUser($username, $nome, $cognome, $telefono, $email);
    echo createResponse('success', 'User created successfully.', []);
} else {
    echo createResponse('error', 'Method not allowed.', []);
}