
<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle flash messages
$notice = '';
if (!empty($_SESSION['flash'])) {
    $notice = $_SESSION['flash'];
    unset($_SESSION['flash']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="min-width:360px">
    <h3 class="mb-3">Login</h3>

    <?php if($notice): ?>
        <div class="alert alert-info"><?= htmlspecialchars($notice) ?></div>
    <?php endif; ?>

    <form method="post" action="/login/authenticate">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <hr>
    <p class="text-center mb-0">
        Don't have an account? <a href="/register">Create account</a>
    </p>
</div>

<script>
    feather.replace();
</script>

</body>
</html>
