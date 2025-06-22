<?php require_once 'app/views/templates/header.php'; ?>
<main class="container mt-4">
  <h2 class="mb-3">How the registration page works</h2>

  <ul>
    <li><strong>Live strength meter </strong>— JS checks length, upper/lower,
        digit, and special char before enabling <em>Create account</em>.</li>
    <li><strong>Password confirmation </strong>— client-side match check +
        server-side check in <code>Create::store()</code>.</li>
    <li><strong>Policy enforcement </strong>— `User::passwordMeetsPolicy()` runs
        on the server.</li>
    <li><strong>Secure storage </strong>— Password hashed with
        <code>password_hash()</code> and stored in
        <code>users.password_hash</code>.</li>
  </ul>

  <a class="btn btn-outline-secondary mt-3" href="/home">Back home</a>
</main>
<?php require_once 'app/views/templates/footer.php'; ?>
