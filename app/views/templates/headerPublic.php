<?php
/* Redirect logged-in users away from public pages */
if (isset($_SESSION['auth'])) {
    header('Location: /home'); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>COSC 4806 – Login</title>

  <!-- Bootstrap 5 & Feather icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
  <script src="https://unpkg.com/feather-icons" defer></script>

  <link rel="icon" href="/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-light">

<nav class="navbar navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">COSC 4806</a>
  </div>
</nav>