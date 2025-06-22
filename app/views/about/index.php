<?php require_once 'app/views/templates/header.php'; ?>

<div class="container py-5">

  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">

      <h1 class="display-5 mb-3">About this&nbsp;Project</h1>
      <p class="lead">
        An MVC login system built for <strong>COSC&nbsp;4806 Assignment&nbsp;3</strong>.
      </p>

      <div class="card mt-4 shadow-sm">
        <div class="card-body text-start">
          <h5 class="card-title">Tech&nbsp;Stack</h5>
          <ul class="list-group list-group-flush small">
            <li class="list-group-item"><i data-feather="code"></i> PHP 8.2</li>
            <li class="list-group-item"><i data-feather="database"></i> MariaDB (filess.io)</li>
            <li class="list-group-item"><i data-feather="columns"></i> Bootstrap 5 &amp; Feather&nbsp;icons</li>
            <li class="list-group-item"><i data-feather="server"></i> Replit Cloud workspace</li>
          </ul>
        </div>
      </div>

      <a href="/home" class="btn btn-primary mt-4">
        <i data-feather="home" class="me-1"></i> Dashboard
      </a>

    </div>
  </div>
</div>

<script>feather.replace()</script>
<?php require_once 'app/views/templates/footer.php'; ?>
