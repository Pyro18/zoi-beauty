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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['user_id'])) {
		$userId = $_GET['user_id'];
		$user = getUser($userId);

		if ($user) {
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
} else {
	createResponse('error', 'Method not allowed.', []);
}