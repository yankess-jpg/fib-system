<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
    <div class="container">
        <div class="navbar-brand">
            <a href="<?= base_url() ?>">
                <i class="fas fa-shield-alt"></i> FBI SYSTEM
            </a>
        </div>
        <div class="navbar-menu">
            <?php if (session()->get('is_logged_in')): ?>
                <a href="<?= base_url('dashboard') ?>" class="nav-link">Dashboard</a>
                <?php if (session()->get('system_role') === 'admin'): ?>
                    <a href="<?= base_url('admin/members') ?>" class="nav-link">Zarządzaj Członkami</a>
                    <a href="<?= base_url('admin/investigations') ?>" class="nav-link">Śledztwa</a>
                <?php endif; ?>
                <span class="nav-user">
                    <?= session()->get('agent_name') ?>
                    <a href="<?= base_url('auth/logout') ?>" class="nav-link logout">Wyloguj</a>
                </span>
            <?php else: ?>
                <a href="<?= base_url('/') ?>" class="nav-link">Strona Główna</a>
                <a href="<?= base_url('recruitment') ?>" class="nav-link">Rekrutacja</a>
                <a href="<?= base_url('informant') ?>" class="nav-link">Informator</a>
                <a href="<?= base_url('auth/login') ?>" class="nav-link btn-login">Zaloguj</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
</body>
</html>