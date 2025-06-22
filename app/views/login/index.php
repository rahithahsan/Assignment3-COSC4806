<?php require_once 'app/views/templates/headerPublic.php'; ?>

<main class="d-flex justify-content-center align-items-center min-vh-100">

  <div class="card shadow p-4" style="max-width:380px; width:100%">

    <h3 class="mb-3 text-center">Log in</h3>

    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-danger small">
        <?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?>
      </div>
    <?php endif; ?>

    <form action="/login/verify" method="post">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" class="form-control" required autocomplete="username">
      </div>

      <div class="mb-3 position-relative">
        <label class="form-label">Password</label>
        <input type="password" name="password" id="pwd"
               class="form-control" required autocomplete="current-password">
        <span class="position-absolute top-50 end-0 translate-middle-y me-3"
              id="togglePwd" style="cursor:pointer">
          <i data-feather="eye"></i>
        </span>
      </div>

      <button class="btn btn-primary w-100">Login</button>
    </form>

    <p class="text-center mt-3 mb-0 small">
      No account? <a href="/create">Register here</a>
    </p>
  </div>

</main>

<script>
/* eye toggle */
document.getElementById('togglePwd').onclick = () => {
  const pw = document.getElementById('pwd');
  pw.type = pw.type === 'password' ? 'text' : 'password';
};

/* wait until the page is parsed AND external scripts have run */
window.addEventListener('DOMContentLoaded', () => {
  if (window.feather) feather.replace();
});
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
