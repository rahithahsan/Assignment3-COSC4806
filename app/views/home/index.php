<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-4">
  <h1>Welcome, <?= htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></h1>
  <p class="lead"><?= date('F jS, Y'); ?></p>
  <p><a href="/logout">Log out</a></p>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>
