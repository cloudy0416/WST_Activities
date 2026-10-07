<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1 class="h2 mb-4">Log In</h1>
    <?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div><?php endif; ?>
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php if ($errors): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
    <form action="<?= site_url('/login') ?>" method="post" class="col-md-5">
        <?= csrf_field() ?>
        <div class="mb-3"><label class="form-label" for="username">Username</label><input class="form-control" id="username" name="username" required maxlength="50" autocomplete="username" value="<?= esc(old('username')) ?>"></div>
        <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" id="password" name="password" type="password" required autocomplete="current-password"></div>
        <button class="btn btn-primary">Log In</button> <a class="btn btn-link" href="<?= site_url('/') ?>">Back to tasks</a>
    </form>
</body>
</html>
