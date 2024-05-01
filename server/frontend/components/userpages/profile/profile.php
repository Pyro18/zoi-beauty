<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>ZOI | PROFILO</title>
</head>
<body>
<section style="background-color: #eee;">
  <div class="container py-5">
    
      <div>
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nome</p>
              </div>
              <div class="col-sm-9">
                <p id="nome" class="text-muted mb-0"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Cognome</p>
              </div>
              <div class="col-sm-9">
                <p id="cognome" class="text-muted mb-0"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p id="username" class="text-muted mb-0"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p id="email" class="text-muted mb-0"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Telefono</p>
              </div>
              <div class="col-sm-9">
                <p id="telefono" class="text-muted mb-0"></p>
              </div>
            </div>
          </div>
        </div>
      <div class="row">
      <div class="card mb-4 mb-md-0">
        <div class="card-body">
          <p id="prenotazioni" class="mb-4"> Prenotazioni attive:</p>
          <table id="prenotazioni-attive" class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Servizio</th>
                <th scope="col">Data e ora</th>
              </tr>
            </thead>
            <tbody>
              <!-- Le righe della tabella saranno inserite qui -->
            </tbody>
          </table>
        </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="/frontend/assets/js/profile/profilo.js"></script>
</body>
</html>