<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h1 class="h2 mb-4"><?= esc($title) ?></h1>
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php if ($errors): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
    <form action="<?= esc($action) ?>" method="post" class="col-md-7">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="title" class="form-label">Task title <span class="text-danger">*</span></label>
            <input id="title" name="title" maxlength="150" required class="form-control" value="<?= esc(old('title', $task['title'] ?? '')) ?>">
        </div>
        <div class="mb-3">
            <label for="task_date" class="form-label">Task date <span class="text-danger">*</span></label>
            <input id="task_date" name="task_date" type="date" required class="form-control" value="<?= esc(old('task_date', $task['task_date'] ?? '')) ?>">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <?php $status = old('status', $task['status'] ?? 'pending'); ?>
            <select id="status" name="status" class="form-select">
                <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </div>
        <button class="btn btn-primary">Save Task</button>
        <a href="<?= site_url('/tasks') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
