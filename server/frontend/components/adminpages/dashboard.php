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

	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
	<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
		<symbol id="check2" viewBox="0 0 16 16">
			<path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
		</symbol>
		<symbol id="circle-half" viewBox="0 0 16 16">
			<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
		</symbol>
		<symbol id="moon-stars-fill" viewBox="0 0 16 16">
			<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
			<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
		</symbol>
		<symbol id="sun-fill" viewBox="0 0 16 16">
			<path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
		</symbol>
	</svg>


	<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
		<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Company name</a>

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
						<h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
									<i class="fa-solid fa-house"></i>
									Dashboard
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-file"></i>
									Orders
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-users"></i>
									Customers
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-chart-simple"></i>
									Reports
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-puzzle"></i>
									Integrations
								</a>
							</li>
						</ul>

						<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
							<span>Saved reports</span>
							<a class="link-secondary" href="#" aria-label="Add a new report">
								<i class="fa-solid fa-circle-plus"></i>
							</a>
						</h6>
						<ul class="nav flex-column mb-auto">
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-file-lines"></i>
									Current month
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-file-lines"></i>
									Last quarter
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-file-lines"></i>
									Social engagement
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center gap-2" href="#">
									<i class="fa-solid fa-file-lines"></i>
									Year-end sale
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
							<li class="nav-item">
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