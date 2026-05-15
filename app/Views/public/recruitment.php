<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="container">
    <section class="recruitment-section">
        <h1>Dołącz do FBI</h1>
        <p>Szukamy zdolnych i oddanych specjalistów do pracy w naszej agencji</p>

        <div class="recruitment-content">
            <div class="recruitment-card">
                <i class="fas fa-user-tie"></i>
                <h3>Wymagania</h3>
                <ul>
                    <li>Obywatelstwo USA</li>
                    <li>Ukończone 21 lat</li>
                    <li>Ważny paszport</li>
                    <li>Przeszkolenie bezpieczeństwa</li>
                </ul>
            </div>

            <div class="recruitment-card">
                <i class="fas fa-laptop"></i>
                <h3>Procedura</h3>
                <ul>
                    <li>Wypełnij formularz aplikacji</li>
                    <li>Przejdź interview</li>
                    <li>Kontrola bezpieczeństwa</li>
                    <li>Szkolenie na terenie agencji</li>
                </ul>
            </div>

            <div class="recruitment-card">
                <i class="fas fa-briefcase"></i>
                <h3>Stanowiska</h3>
                <ul>
                    <li>Special Agent</li>
                    <li>Cyber Agent</li>
                    <li>Analyst</li>
                    <li>Support Staff</li>
                </ul>
            </div>
        </div>

        <div class="recruitment-form">
            <h2>Formularz Aplikacji</h2>
            <form method="post" action="<?= base_url('recruitment/apply') ?>">
                <?= csrf_field() ?>
                <div class="form-row">
                    <input type="text" name="first_name" placeholder="Imię" required>
                    <input type="text" name="last_name" placeholder="Nazwisko" required>
                </div>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Telefon" required>
                <textarea name="motivation" placeholder="Dlaczego chcesz dołączyć do FBI?" required></textarea>
                <button type="submit" class="btn btn-primary">Wyślij Aplikację</button>
            </form>
        </div>
    </section>
</div>

<?= $this->include('layouts/footer') ?>