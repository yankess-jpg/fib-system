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
                <strong>❌ Błąd:</strong> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <strong>✅ Sukces:</strong> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('auth/login') ?>" class="login-form" enctype="application/x-www-form-urlencoded">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="badge">
                    <i class="fas fa-shield-alt"></i> Numer Odznaki:
                </label>
                <input type="text" 
                       id="badge" 
                       name="badge" 
                       class="form-control" 
                       required 
                       placeholder="FIB-2026-001" 
                       value="<?= old('badge') ?>">
                <small class="form-text text-muted">np. FIB-2026-001</small>
            </div>

            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> Hasło:
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control" 
                       required 
                       placeholder="••••••••">
                <small class="form-text text-muted">Twoje hasło dostępu</small>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> Zaloguj
            </button>
        </form>

        <div class="login-footer">
            <p>Jesteś obywatelem? <a href="<?= base_url('informant') ?>"><i class="fas fa-user-secret"></i> Zostań Informatorem</a></p>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>