<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="hero">
    <div class="hero-content">
        <h1>FBI System</h1>
        <p>Federalny Biuro Śledcze - Portal Informacyjny</p>
        <div class="hero-buttons">
            <a href="<?= base_url('recruitment') ?>" class="btn btn-primary">Rekrutacja</a>
            <a href="<?= base_url('informant') ?>" class="btn btn-secondary">Zostań Informatorem</a>
        </div>
    </div>
</div>

<div class="container">
    <section class="info-section">
        <h2>Wiadomości i Komunikaty</h2>
        <div class="announcements">
            <div class="announcement">
                <span class="date">2026-05-15</span>
                <h3>Nowe wytyczne bezpieczeństwa</h3>
                <p>Wszyscy agenci muszą przejść nowe szkolenie z bezpieczeństwa cybernetycznego...</p>
            </div>
            <div class="announcement">
                <span class="date">2026-05-14</span>
                <h3>Zmiana procedur archiwalnych</h3>
                <p>Zmieniamy procedury archiwizacji przypadków dla większej efektywności...</p>
            </div>
        </div>
    </section>
</div>

<?= $this->include('layouts/footer') ?>