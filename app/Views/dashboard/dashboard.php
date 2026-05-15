<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="dashboard-container">
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="<?= base_url('dashboard') ?>" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="<?= base_url('dashboard/my-investigations') ?>"><i class="fas fa-folder"></i> Moje Sprawy</a></li>
            <li><a href="<?= base_url('dashboard/notes') ?>"><i class="fas fa-sticky-note"></i> Moje Notatki</a></li>
        </ul>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-header">
            <h1>Witaj, <?= session()->get('agent_name') ?></h1>
            <p><?= session()->get('division') ?></p>
        </div>

        <div class="dashboard-stats">
            <div class="stat-card">
                <i class="fas fa-folder-open"></i>
                <div>
                    <h3><?= count($agent_investigations) ?></h3>
                    <p>Przypisane Sprawy</p>
                </div>
            </div>
        </div>

        <section class="dashboard-section">
            <h2>Ostatnie Sprawy</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Numer Sprawy</th>
                        <th>Nazwa</th>
                        <th>Status</th>
                        <th>Priorytet</th>
                        <th>Prowadzący</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agent_investigations as $inv): ?>
                        <tr>
                            <td><?= $inv['case_number'] ?></td>
                            <td><?= $inv['title'] ?></td>
                            <td>
                                <span class="badge badge-<?= strtolower($inv['status']) ?>">
                                    <?= ucfirst($inv['status']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-priority-<?= strtolower($inv['priority']) ?>">
                                    <?= ucfirst($inv['priority']) ?>
                                </span>
                            </td>
                            <td><?= $inv['lead_agent_name'] ?? 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>

<?= $this->include('layouts/footer') ?>