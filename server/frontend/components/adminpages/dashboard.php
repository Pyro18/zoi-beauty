<?php 
session_start();

if (!isset($_SESSION['admin_id'])) {
	header('Location: /admin/login');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="/frontend/assets/css/admin/dashboard.css">
	
	<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

<!-- jQuery UI JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<link
		rel="stylesheet"
		data-purpose="Layout StyleSheet"
		title="Web Awesome"
		href="/css/app-wa-fba26eda6a3fd6b4d0ce0def1e2ba1d7.css?vsn=d"
	>

	<link
		rel="stylesheet"
		href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css"
	>

	<link
		rel="stylesheet"
		href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css"
	>

	<link
		rel="stylesheet"
		href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css"
	>

	<link
		rel="stylesheet"
		href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css"
	>

	<link
		rel="stylesheet"
		href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css"
	>

	<title>ZOI | ADMIN</title>

</head>
<body>



	<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
		<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">[ ZOI ]</a>

		<ul class="navbar-nav flex-row d-md-none">
			<li class="nav-item text-nowrap">
				<button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			</li>
			<li class="nav-item text-nowrap">
				<button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa-regular fa-list"></i>
				</button>
			</li>
		</ul>

		<div id="navbarSearch" class="navbar-search w-100 collapse">
			<input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
		</div>
	</header>

	<div class="container-fluid">
		<div class="row">
			<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
				<div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
					<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="sidebarMenuLabel">[ ZOI ]</h5>
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
						<ul class="nav flex-column">
							<li id="bookingsButton" class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
									<i class="fa-solid fa-house"></i>
									Prenotazioni
								</a>
							</li>
							<li id="usersButton" class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
								<i class="fa-solid fa-user"></i>
									Utenti
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-users"></i>
									?????
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-chart-simple"></i>
									?????
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-puzzle"></i>
									?????
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-file"></i>
									?????
								</a>
							</li>
						</ul>

						<hr class="my-3">

						<ul class="nav flex-column mb-auto">
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-gear"></i>
									Settings
								</a>
							</li>
							<li id="logoutButton" class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-door-closed"></i>
									Sign out
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Prenotazioni</h1>
					<button type="button" class="btn btn-primary" id="addBookingButton">
						<i class="fa-solid fa-plus"></i>
					</button>
				</div>
				<div id="calendar"></div>
				<!-- Utenti -->
				<div id="userTable"> </div>
			</div>
		</main>

				

		<div class="modal" tabindex="-1" id="updateModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Update Booking</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="updateForm">
							<div class="mb-3">
								<label for="updateDateTime" class="form-label">Date and Time</label>
								<input type="datetime-local" class="form-control" id="updateDateTime">
							</div>
							<button type="submit" class="btn btn-primary">Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modale per aggiungere una prenotazione -->
		<div class="modal" tabindex="-1" id="addModal">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title">Aggiungi Prenotazione</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
										<form id="addForm">
												<div class="mb-3">
													<label for="searchUser" class="form-label">Cerca Utente</label>
													<input list="userList" type="text" class="form-control" id="searchUser">
													<datalist id="userList"></datalist>
												</div>

												<!-- nome, cognome, telefono e email -->
                        <input type="text" id="userId" name="userId">
                        <div class="mb-3">
													<label for="userName" class="form-label">Nome</label>
													<input type="text" class="form-control" id="userName">
												</div>
												<div class="mb-3">
													<label for="userSurname" class="form-label">Cognome</label>
													<input type="text" class="form-control" id="userSurname">
												</div>
												<div class="mb-3">
													<label for="userPhone" class="form-label">Telefono</label>
													<input type="text" class="form-control" id="userPhone">
												</div>
												<div class="mb-3">
													<label for="userEmail" class="form-label">Email</label>
													<input type="text" class="form-control" id="userEmail">
												</div>
												<div class="mb-3">
													<label for="userPhone" class="form-label">Data e Ora</label>
													<input type="datetime-local" class="form-control" id="dateTime">
												</div>
												<div class="mb-3">
													<label for="serviceSelect" class="form-label">Seleziona Servizio</label>
													<select class="form-control" id="serviceSelect"></select>
												</div>
												<button type="submit" class="btn btn-primary">Aggiungi</button>
										</form>
								</div>
						</div>
				</div>
		</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.js'></script>
<script src="/frontend/assets/js/admin/dashboard.js"></script>

</body>
</html>