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
        <a href="<?= site_url('/profile') ?>" class="btn btn-secondary">Profile</a>
        <a href="<?= site_url('/about') ?>" class="btn btn-primary">About</a>
    </nav>

    <h2>About the Developer</h2>
    <div class="card col-md-6 mt-3">
        <div class="card-body">
            <h5>Developer Information</h5>
            <p><strong>Name:</strong> Paul Matthew M. Roxas</p>
            <p><strong>Section:</strong> TW35</p>
            <p><strong>Course:</strong> IT0049 - Web System Technologies</p>
            <p><strong>Description:</strong> This application serves as Technical Summative Assessment 1 for IT0049, demonstrating database filtering and MVC architecture in CodeIgniter 4.</p>
        </div>
    </div>
</body>
</html>