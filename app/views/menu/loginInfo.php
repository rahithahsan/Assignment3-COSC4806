<?php require_once 'app/views/templates/header.php'; ?>

<div class="container py-5">

  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0"><i data-feather="log-in" class="me-2"></i>How the&nbsp;Login page works</h4>
        </div>

        <div class="card-body">
          <ul class="list-group list-group-flush">

            <li class="list-group-item">
              <i data-feather="database" class="me-1"></i>
              <strong>PDO lookup</strong> – <code>User::authenticate()</code>
              fetches the row with a prepared statement.
            </li>

            <li class="list-group-item">
              <i data-feather="key" class="me-1"></i>
              <strong>Bcrypt hash</strong> – <code>password_verify()</code>
              compares the supplied password against the stored hash.
            </li>

            <li class="list-group-item">
              <i data-feather="alert-triangle" class="me-1"></i>
              <strong>Per-user lock-out</strong> – 3 bad attempts within 60 s
              triggers <code>User::lockedOut()</code>.
            </li>

            <li class="list-group-item">
              <i data-feather="clipboard" class="me-1"></i>
              <strong>Logging</strong> – every attempt is inserted into the
              <code>log</code> table with outcome and timestamp.
            </li>

            <li class="list-group-item">
              <i data-feather="smartphone" class="me-1"></i>
              <strong>UI/UX touches</strong> – Bootstrap card,
              eye-toggle icon, flash errors.
            </li>

          </ul>
        </div>

        <div class="card-footer text-end">
          <a href="/home" class="btn btn-outline-secondary">
            <i data-feather="arrow-left"></i> Back home
          </a>
        </div>
      </div>

    </div>
  </div>
</div>

<script>feather.replace()</script>
<?php require_once 'app/views/templates/footer.php'; ?>
