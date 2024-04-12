<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/footer.css">


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
    <title>ZOI | REGISTER</title>
</head>
<body>
<section class="vh-100" style="background-color: #d6bcbc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block" style="overflow: hidden; height: 100%; display: flex;">
                            <img src="https://i.imgur.com/Xlef5Xj.jpg" alt="register form"
                                 class="img-fluid"
                                 style="border-radius: 1rem 0 0 1rem; object-fit: cover; min-width: 100%; height: auto;"
                            />
                        </div>

                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form id="registerForm">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0">[ ZOI ]</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Crea il tuo account</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label" for="nomeInput">Nome</label>
                                                <input type="text" id="nomeInput" class="form-control form-control-lg" name="nome" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label" for="cognomeInput">Cognome</label>
                                                <input type="text" id="cognomeInput" class="form-control form-control-lg" name="cognome" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="usernameInput">Username</label>
                                            <input type="text" id="usernameInput" class="form-control form-control-lg" name="username" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="telefonoInput">Telefono</label>
                                            <input type="text" id="telefonoInput" class="form-control form-control-lg" name="telefono" />
                                        </div>
                                    </div>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="emailInput">Email</label>
                                        <input type="email" id="emailInput" class="form-control form-control-lg" name="email" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label" for="passwordInput">Password</label>
                                                <input type="password" id="passwordInput" class="form-control form-control-lg" name="password" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label" for="confirmPasswordInput">Conferma Password</label>
                                                <input type="password" id="confirmPasswordInput" class="form-control form-control-lg" name="confirm_password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-1 mb-4 d-flex justify-content-between">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg" type="submit">Registrati</button>
                                        <p class="mb-0" style="color: #393f81;">Hai già un account? <a href="#!" style="color: #393f81;">Accedi qui!</a></p>
                                    </div>
                                    <div class="container text-center mt-4">
                                        <a href="#!" class="small text-muted">Termini e condizioni.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="success-register"></div>
    <div id="error-register"></div>
</section>
    <script src="/frontend/assets/js/auth/register.js"></script>
</body>
</html>
