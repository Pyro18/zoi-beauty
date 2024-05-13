<html lang="en">
<head>
    <!-- Meta tags per l'encoding e la visualizzazione responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Collegamento ai fogli di stile di Bootstrap e al tuo foglio di stile personalizzato -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/frontend/assets/css/navbar_footer/navbar.css">
    <script src="/frontend/assets/js/navbar/navabar.js"></script>
</head>

<body>
<!-- Inizio della barra di navigazione -->
<nav class="navbar navbar-custom navbar-expand-lg" aria-label="Offcanvas navbar large">
    <div class="container-fluid">

        <!-- Logo del sito -->
        <a class="navbar-brand" href="/" style="margin-right: 0;padding-top: 0;padding-bottom: 0; font-weight: 700">[ ZOI ]</a>

        <!-- Toggler per la navigazione mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas per la navigazione mobile -->
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label" style="font-weight: 700">[ ZOI ]</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!-- Elementi del menu a comparsa -->
            <div class="offcanvas-body p-2">
                <ul class="navbar-nav">
                    <li><a href="/" class="link link-theme link-arrow">HOME</a></li>
                    <li><a href="#about" class="link link-theme link-arrow">NOI</a></li>
                    <li><a href="#booknow" class="link link-theme link-arrow">SERVIZI</a></li>
                    <!-- <li><a href="#four" class="link link-theme link-arrow">CONTATTI</a></li> -->
                </ul>

                <!-- Informazioni sull'utente -->
                <div class="user-info" id="user-info" style="padding-top: 7px;">

                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Collegamento ai file JavaScript di Bootstrap e al tuo file JavaScript personalizzato -->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
