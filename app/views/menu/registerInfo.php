<?php require_once 'app/views/templates/header.php'; ?>

<div class="container py-5">

  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0"><i data-feather="user-plus" class="me-2"></i>How the&nbsp;Registration page works</h4>
        </div>

        <div class="card-body">
          <ul class="list-group list-group-flush">

            <li class="list-group-item">
              <i data-feather="check-circle" class="text-success me-1"></i>
              <strong>Live strength meter</strong> – JavaScript validates
              length, upper/lower, digit &amp; special character before
              enabling <em>Create&nbsp;account</em>.
            </li>

            <li class="list-group-item">
              <i data-feather="check-circle" class="text-success me-1"></i>
              <strong>Password confirmation</strong> – client-side match check
              <span class="text-muted">(JS)</span> plus a server-side check in
              <code>Create::store()</code>.
            </li>

            <li class="list-group-item">
              <i data-feather="lock" class="me-1"></i>
              <strong>Policy enforcement</strong> – handled in
              <code>User::passwordMeetsPolicy()</code>.
            </li>

            <li class="list-group-item">
              <i data-feather="shield" class="me-1"></i>
              <strong>Secure storage</strong> – passwords are hashed with
              <code>password_hash()</code> and stored in
              <code>users.password_hash</code>.
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
