
<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle flash messages
$notice = '';
<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['flash'])) {
    $notice = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

$username = $_SESSION['username'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/home">MyApp</a>
        <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">Welcome, <?= htmlspecialchars($username) ?>!</span>
            <a class="nav-link" href="/logout">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if($notice): ?>
                <div class="alert alert-success"><?= htmlspecialchars($notice) ?></div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Dashboard</h2>
                    <p class="card-text">You are successfully logged in!</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Profile</h5>
                                    <p class="card-text">Username: <?= htmlspecialchars($username) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Status</h5>
                                    <p class="card-text">Account Active</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
