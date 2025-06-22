<?php require_once 'app/views/templates/header.php'; ?>

<main class="d-flex justify-content-center align-items-center min-vh-100">

  <div class="card shadow p-4" style="max-width:480px; width:100%">

    <h3 class="mb-2 text-center">
      Welcome, <?= htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!
    </h3>

    <p class="text-muted text-center mb-4">
      <?= date('l, F j Y • g:i A'); ?>
    </p>

    <div class="d-grid">
      <a href="/logout" class="btn btn-outline-danger">
        <i data-feather="log-out" class="me-1"></i> Log out
      </a>
    </div>

  </div>

</main>

<script>
/* render feather log-out icon */
window.addEventListener('DOMContentLoaded', () => {
  if (window.feather) feather.replace();
});
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
