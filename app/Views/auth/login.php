<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <i class="fas fa-lock"></i>
            <h1>FBI SYSTEM</h1>
            <p>Panel Logowania Agentów</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="post" class="login-form">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="badge">Numer Odznaki:</label>
                <input type="text" id="badge" name="badge" class="form-control" required placeholder="FIB-2026-001">
            </div>

            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Zaloguj</button>
        </form>

        <div class="login-footer">
            <p>Jesteś obywatelem? <a href="<?= base_url('informant') ?>">Zostań Informatorem</a></p>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>