<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/frontend/assets/css/homepage/home-services.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <section class="section">
                <div class="meta">Welcome to</div>
                <h2 class="name">[ SERVICES ]</h2>
                <p class="description">Vestibulum ut mauris euismod, tristique augue sed, consequat metus. Duis fermentum massa ac metus suscipit tincidunt. Praesent felis felis, pretium sit amet vehicula at, posuere at mauris.</p>
            </section>
        </div>
    </div>
</div>

<div class="Services">
    <div class="Categories">
        <div class="Category">
            <img src="category1.png" alt="Category 1">
            <p>Category 1</p>
        </div>
        <div class="Category Active">
            <img src="category2.png" alt="Category 2">
            <p>Category 2</p>
        </div>
        <!-- Aggiungi altre categorie qui -->
    </div>
    <div class="Types">
        <div class="Type">
            <p class="Name">Type 1</p>
            <div class="Contain"></div>
            <img class="Expand" src="expand.png" alt="Expand">
        </div>
        <div class="Type Active">
            <p class="Name">Type 2</p>
            <div class="Contain"></div>
            <img class="Expand ExpandOpen" src="expand.png" alt="Expand">
        </div>
        <!-- Aggiungi altri tipi qui -->
    </div>
    <div id="services-container" class="Services"> <!-- Aggiunto id="services-container" -->
        <!-- I servizi verranno renderizzati qui -->
    </div>
    <a class="Book">Book now</a>
</div>

<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/frontend/assets/js/homepage/services.js"></script>
</body>
</html>
