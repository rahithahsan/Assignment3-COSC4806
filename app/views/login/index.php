
<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* ---------- flash message handling ---------- */
$notice = '';
if (!empty($_SESSION['flash'])) {
  $notice = $_SESSION['flash'];
  unset($_SESSION['flash']);          // display once
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <!-- Bootstrap & Feather icons -->
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="min-width: 360px;">
  <h3 class="mb-3">Log in</h3>

  <?php if ($notice): ?>
    <div class="alert alert-info"><?= htmlspecialchars($notice) ?></div>
  <?php endif; ?>

  <form action="/login/verify" method="post">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required autocomplete="username">
    </div>

    <div class="mb-3 position-relative">
      <label class="form-label">Password</label>
      <input type="password" name="password" id="pwd" class="form-control" required autocomplete="current-password">
      <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="togglePwd" style="cursor:pointer">
        <i data-feather="eye"></i>
      </span>
    </div>

    <button class="btn btn-primary w-100">Submit</button>
  </form>

  <hr>
  <p class="text-center mb-0">
    Need an account?
    <a href="/register">Register here</a>
  </p>
</div>

<script>
const pwd = document.getElementById('pwd');
document.getElementById('togglePwd').addEventListener('click', () => {
  pwd.type = (pwd.type === 'password') ? 'text' : 'password';
});
feather.replace();
</script>
</body>
</html>
