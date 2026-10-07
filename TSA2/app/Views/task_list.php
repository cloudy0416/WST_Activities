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
        <a href="<?= site_url('/tasks') ?>" class="btn btn-primary">All Tasks</a>
        <a href="<?= site_url('/profile') ?>" class="btn btn-secondary">Profile</a>
        <a href="<?= site_url('/about') ?>" class="btn btn-secondary">About</a>
        <?php if (session()->get('isLoggedIn')): ?>
            <a href="<?= site_url('/tasks/new') ?>" class="btn btn-success">New Task</a>
            <form action="<?= site_url('/logout') ?>" method="post" class="d-inline"><?= csrf_field() ?><button class="btn btn-outline-danger">Log Out</button></form>
        <?php else: ?><a href="<?= site_url('/login') ?>" class="btn btn-outline-primary">Log In to Manage</a><?php endif; ?>
    </nav>

    <?php foreach (['success', 'error'] as $messageType): if (session()->getFlashdata($messageType)): ?>
        <div class="alert alert-<?= $messageType === 'error' ? 'danger' : 'success' ?>"><?= esc(session()->getFlashdata($messageType)) ?></div>
    <?php endif; endforeach; ?>

    <h2>All Tasks Listing</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Task Date</th>
                <th>Created At</th>
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
                        <td><?= esc($task['created_at']) ?></td>
                        <?php if (session()->get('isLoggedIn')): ?><td class="text-nowrap">
                            <a class="btn btn-sm btn-primary" href="<?= site_url('/tasks/' . $task['id'] . '/edit') ?>">Edit</a>
                            <form class="d-inline" action="<?= site_url('/tasks/' . $task['id'] . '/delete') ?>" method="post" onsubmit="return confirm('Archive this task?')">
                                <?= csrf_field() ?><button class="btn btn-sm btn-outline-danger">Archive</button>
                            </form>
                        </td><?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="<?= session()->get('isLoggedIn') ? 6 : 5 ?>" class="text-center">No tasks found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
