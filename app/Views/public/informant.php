<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="container">
    <section class="informant-section">
        <h1>Program Informatora</h1>
        <p>Pomóż nam zwalczać przestępczość - zgłoś informacje o podejrzanej działalności</p>

        <div class="informant-info">
            <div class="info-box">
                <h3>🔒 Poufność</h3>
                <p>Twoja tożsamość jest chroniona. Zapewniamy całkowitą anonimowość.</p>
            </div>

            <div class="info-box">
                <h3>💰 Wynagrodzenie</h3>
                <p>Możesz otrzymać znaczne wynagrodzenie za ważne informacje.</p>
            </div>

            <div class="info-box">
                <h3>🛡️ Ochrona</h3>
                <p>Program ochrony świadków zapewnia bezpieczeństwo Tobie i Twojej rodzinie.</p>
            </div>
        </div>

        <div class="informant-form">
            <h2>Zgłoś Informacje</h2>
            <form method="post" action="<?= base_url('informant/submit') ?>">
                <?= csrf_field() ?>
                <input type="text" name="subject" placeholder="Temat zgłoszenia" required>
                <textarea name="description" placeholder="Opisz w szczegółach co widziałeś/słyszałeś..." required style="height: 150px;"></textarea>
                <div class="form-row">
                    <input type="text" name="contact_method" placeholder="Metoda kontaktu (email/telefon)" required>
                    <label>
                        <input type="checkbox" name="anonymous" value="1"> Chcę pozostać anonimowy
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Wyślij Zgłoszenie</button>
            </form>
        </div>
    </section>
</div>

<?= $this->include('layouts/footer') ?>