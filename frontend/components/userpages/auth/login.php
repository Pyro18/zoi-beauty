<?php
    session_start();
    $_SESSION['hide_navbar'] = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/frontend/assets/css/auth/login.css">



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
    <title>ZOI | LOGIN</title>

</head>
<body>
    <h1>Login Page</h1>
    <form action="/" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
    <a href="/register">Register</a>
</body>
</html>
