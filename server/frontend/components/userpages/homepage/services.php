<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="\frontend\assets\css\homepage\home-services.css">

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
</head>
<body>



<div class="container" id="booknow">
    <div class="row">
        <div class="col">
            <section class="section">
                <div class="meta">What we do</div>
                <h2 class="name">[ SERVICES ]</h2>
                <p class="description">Vestibulum ut mauris euismod, tristique augue sed, consequat metus. Duis fermentum massa ac metus suscipit tincidunt. Praesent felis felis, pretium sit amet vehicula at, posuere at mauris.</p>
            </section>
        </div>
    </div>
</div>


<div class="Services">
  <div class="Categories">
  </div>
  <div class="Types">
  </div>
  <div class="Services service-container">
  </div>
  <a class="Book">Book now</a>
</div>


<!-- Modale per la prenotazione -->
<div id="alertContainer"></div>
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel">Prenotazione</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="bookingForm" method="post">
          <!-- Aggiungi qui i campi del form per i dettagli della prenotazione -->
          <div class="mb-3">
            <label for="bookingDate" class="form-label">Data</label>
            <input type="date" class="form-control" id="bookingDate" name="date">
          </div>
          <div class="mb-3">
            <label for="bookingTime" class="form-label">Ora</label>
            <input type="time" class="form-control" id="bookingTime" name="time", min="8:00", max="18:00">
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="submit" class="btn btn-primary" id="submitBooking">Prenota</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/frontend/assets/js/homepage/services.js"></script>
</body>
</html>
