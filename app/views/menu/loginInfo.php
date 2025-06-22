<?php require_once 'app/views/templates/header.php'; ?>
<main class="container mt-4">
  <h2 class="mb-3">How the login page works</h2>

  <ul>
    <li><strong>PDO lookup&nbsp;</strong>— `User::authenticate()` pulls the
        user row with a prepared statement.</li>
    <li><strong>Bcrypt hash&nbsp;</strong>— `password_verify()` compares the
        submitted password with <code>password_hash</code> in DB.</li>
    <li><strong>Per-user lock-out&nbsp;</strong>— After 3 bad attempts within
        60 s, <code>User::lockedOut()</code> blocks login.</li>
    <li><strong>Logging&nbsp;</strong>— Every attempt (good/bad) is written to
        the <code>log</code> table.</li>
    <li><strong>UI UX&nbsp;</strong>— Bootstrap card, eye-toggle icon, Flash
        message for errors.</li>
  </ul>

  <a class="btn btn-outline-secondary mt-3" href="/home">Back home</a>
</main>
<?php require_once 'app/views/templates/footer.php'; ?>
