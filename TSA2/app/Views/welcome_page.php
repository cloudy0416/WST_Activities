<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <nav class="mb-4">
        <a href="<?= site_url('/') ?>" class="btn btn-primary">Today's Tasks</a>
        <a href="<?= site_url('/tasks') ?>" class="btn btn-secondary">All Tasks</a>
        <a href="<?= site_url('/profile') ?>" class="btn btn-secondary">Profile</a>
        <a href="<?= site_url('/about') ?>" class="btn btn-secondary">About</a>
        <?php if (session()->get('isLoggedIn')): ?>
            <a href="<?= site_url('/tasks/new') ?>" class="btn btn-success">New Task</a>
            <form action="<?= site_url('/logout') ?>" method="post" class="d-inline"><?= csrf_field() ?><button class="btn btn-outline-danger">Log Out</button></form>
        <?php else: ?><a href="<?= site_url('/login') ?>" class="btn btn-outline-primary">Log In to Manage</a><?php endif; ?>
    </nav>

    <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div><?php endif; ?>

    <h2>Today's Tasks (<?= date('Y-m-d') ?>)</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Task Date</th>
                <?php if (session()->get('isLoggedIn')): ?><th>Actions</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id'] ?></td>
                        <td><?= esc($task['title']) ?></td>
                        <td><span class="badge bg-<?= $task['status'] === 'completed' ? 'success' : 'warning' ?>"><?= esc($task['status']) ?></span></td>
                        <td><?= esc($task['task_date']) ?></td>
                        <?php if (session()->get('isLoggedIn')): ?><td><a class="btn btn-sm btn-primary" href="<?= site_url('/tasks/' . $task['id'] . '/edit') ?>">Edit</a></td><?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="<?= session()->get('isLoggedIn') ? 5 : 4 ?>" class="text-center">No tasks scheduled for today.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
