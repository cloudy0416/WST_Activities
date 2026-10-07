<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <nav class="mb-4">
        <a href="<?= site_url('/') ?>" class="btn btn-secondary">Today's Tasks</a>
        <a href="<?= site_url('/tasks') ?>" class="btn btn-secondary">All Tasks</a>
        <a href="<?= site_url('/profile') ?>" class="btn btn-primary">Profile</a>
        <a href="<?= site_url('/about') ?>" class="btn btn-secondary">About</a>
    </nav>

    <h2>User Profile</h2>
    <?php if ($user): ?>
        <div class="card col-md-6 mt-3">
            <div class="card-body">
                <h5 class="card-title"><?= esc($user['full_name']) ?></h5>
                <p class="card-text"><strong>Username:</strong> <?= esc($user['username']) ?></p>
                <p class="card-text"><strong>Email:</strong> <?= esc($user['email']) ?></p>
                <p class="card-text"><small class="text-muted">Member since: <?= $user['created_at'] ?></small></p>
            </div>
        </div>
    <?php else: ?>
        <p>User profile record not found.</p>
    <?php endif; ?>
</body>
</html>