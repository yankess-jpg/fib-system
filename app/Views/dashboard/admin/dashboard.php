<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="dashboard-container">
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="<?= base_url('dashboard') ?>" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="<?= base_url('admin/members') ?>"><i class="fas fa-users"></i> Zarządzaj Członkami</a></li>
            <li><a href="<?= base_url('admin/investigations') ?>"><i class="fas fa-folder"></i> Śledztwa</a></li>
            <li><a href="<?= base_url('admin/reports') ?>"><i class="fas fa-chart-bar"></i> Raporty</a></li>
        </ul>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-header">
            <h1>Panel Administracyjny</h1>
            <p>Zalogowano jako: <?= session()->get('agent_name') ?></p>
        </div>

        <div class="dashboard-stats">
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div>
                    <h3><?= count($all_agents) ?></h3>
                    <p>Aktywnych Agentów</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-folder-open"></i>
                <div>
                    <h3><?= count($recent_investigations) ?></h3>
                    <p>Otwartych Spraw</p>
                </div>
            </div>
        </div>

        <section class="dashboard-section">
            <h2>Wszyscy Agenci</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Odznaka</th>
                        <th>Ranga</th>
                        <th>Wydział</th>
                        <th>Status</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_agents as $agent): ?>
                        <tr>
                            <td><?= $agent['agent_name'] ?></td>
                            <td><?= $agent['agent_badge'] ?></td>
                            <td><?= $agent['rank'] ?></td>
                            <td><?= $agent['division'] ?></td>
                            <td>
                                <span class="badge badge-<?= strtolower($agent['status']) ?>">
                                    <?= ucfirst($agent['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/members/view/' . $agent['agent_id']) ?>" class="btn-small">Podgląd</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="dashboard-section">
            <h2>Ostatnie Sprawy</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Numer</th>
                        <th>Nazwa</th>
                        <th>Typ</th>
                        <th>Status</th>
                        <th>Prowadzący</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_investigations as $inv): ?>
                        <tr>
                            <td><?= $inv['case_number'] ?></td>
                            <td><?= $inv['title'] ?></td>
                            <td><?= $inv['case_type'] ?></td>
                            <td>
                                <span class="badge badge-<?= strtolower($inv['status']) ?>">
                                    <?= ucfirst($inv['status']) ?>
                                </span>
                            </td>
                            <td><?= $inv['lead_agent_name'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>

<?= $this->include('layouts/footer') ?>