<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Web Admin') ?></title>

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />

    <!-- Link ke CSS Material Baru Anda -->
    <link rel="stylesheet" href="<?= base_url('assets/css/material_style.css') ?>">

    <!-- Flatpickr (Date Picker) CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script>
        // Terapkan dark mode class di body SEBELUM halaman dirender
        (function() {
            try {
                var theme = window.localStorage.getItem('themeMode');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark-mode');
                }
            } catch (e) {}
        })();
    </script>
</head>

<body class="<?= (isset($_COOKIE['themeMode']) && $_COOKIE['themeMode'] === 'dark') ? 'dark-mode' : '' ?>"> <!-- Class 'sidebar-open' atau 'collapsed' ditambahkan oleh JS -->

    <div class="layout-container" id="layout-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <span class="material-symbols-outlined">dataset</span>
                <span class="logo-text">Web Admin</span>
            </div>
            <nav class="sidebar-nav">
                <?php
                $departmentId = session()->get('department_id');
                $uri = service('uri');
                ?>

                <?php if ($departmentId == 1): // POS 
                ?>
                    <div class="sidebar-heading">POS Menu</div>
                    <a href="<?= site_url('/') ?>" class="nav-link <?= $uri->getSegment(1) == '' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">dashboard</span>
                        <span class="nav-text">Dashboard POS</span>
                    </a>
                    <a href="<?= site_url('pos/transaksi') ?>" class="nav-link <?= $uri->getSegment(1) == 'pos' && $uri->getSegment(2) == 'transaksi' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">point_of_sale</span>
                        <span class="nav-text">Transaksi</span>
                    </a>
                    <div class="has-sub <?= in_array($uri->getSegment(1), ['penjualan', 'datapenjualan']) ? 'open' : '' ?>">
                        <button class="nav-toggle <?= in_array($uri->getSegment(1), ['penjualan', 'datapenjualan']) ? 'active' : '' ?>">
                            <span class="material-symbols-outlined nav-icon">sell</span>
                            <span class="nav-text">Penjualan</span>
                            <span class="material-symbols-outlined nav-arrow">expand_more</span>
                        </button>
                        <ul class="submenu">
                            <li><a href="<?= site_url('penjualan') ?>" class="nav-link <?= $uri->getSegment(1) == 'penjualan' ? 'active' : '' ?>">Input Penjualan</a></li>
                            <li><a href="<?= site_url('datapenjualan') ?>" class="nav-link <?= $uri->getSegment(1) == 'datapenjualan' ? 'active' : '' ?>">Data Penjualan</a></li>
                        </ul>
                    </div>
                    <a href="<?= site_url('batas-tanggal') ?>" class="nav-link <?= $uri->getSegment(1) == 'batas-tanggal' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">date_range</span>
                        <span class="nav-text">Batas Tanggal</span>
                    </a>

                <?php elseif ($departmentId == 2): // Backoffice 
                ?>
                    <div class="sidebar-heading">Backoffice Menu</div>
                    <a href="<?= site_url('/') ?>" class="nav-link <?= $uri->getSegment(1) == '' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">dashboard</span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="<?= site_url('backoffice/laporan') ?>" class="nav-link <?= $uri->getSegment(1) == 'backoffice' && $uri->getSegment(2) == 'laporan' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">summarize</span>
                        <span class="nav-text">Laporan</span>
                    </a>

                <?php elseif ($departmentId == 3): // General 
                ?>
                    <div class="sidebar-heading">General Menu</div>
                    <a href="<?= site_url('/') ?>" class="nav-link <?= $uri->getSegment(1) == '' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">dashboard</span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="<?= site_url('datapenjualan') ?>" class="nav-link <?= $uri->getSegment(1) == 'datapenjualan' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">receipt_long</span>
                        <span class="nav-text">Data Penjualan</span>
                    </a>

                    <div class="sidebar-heading">Master</div>
                    <a href="<?= base_url('mastersales') ?>" class="nav-link <?= $uri->getSegment(1) == 'mastersales' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">badge</span>
                        <span class="nav-text">Sales / Pegawai</span>
                    </a>
                    <a href="<?= base_url('mastercustomer') ?>" class="nav-link <?= $uri->getSegment(1) == 'mastercustomer' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">groups</span>
                        <span class="nav-text">Customer</span>
                    </a>
                    <a href="<?= site_url('user') ?>" class="nav-link <?= $uri->getSegment(1) == 'user' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">manage_accounts</span>
                        <span class="nav-text">Manajemen User</span>
                    </a>
                    <a href="<?= site_url('masterbarang') ?>" class="nav-link <?= $uri->getSegment(1) == 'masterbarang' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">inventory_2</span>
                        <span class="nav-text">Master Barang</span>
                    </a>

                    <?php
                    $klasifikasi_segments = [
                        'masterkategori',
                        'masterdaya',
                        'masterdimensi',
                        'masterfiting',
                        'mastergondola',
                        'masterjenis',
                        'masterjumlahmata',
                        'masterkaki',
                        'mastermerk',
                        'mastermodel',
                        'masterpelengkap',
                        'mastersatuan',
                        'masterukuranbarang',
                        'mastervoltase',
                        'masterwarnabibir',
                        'masterwarnabody',
                        'masterwarnasinar'
                    ];
                    $klasifikasiActive = in_array($uri->getSegment(1), $klasifikasi_segments);
                    ?>
                    <div class="has-sub <?= $klasifikasiActive ? 'open' : '' ?>">
                        <button class="nav-toggle <?= $klasifikasiActive ? 'active' : '' ?>">
                            <span class="material-symbols-outlined nav-icon">category</span>
                            <span class="nav-text">Master Klasifikasi</span>
                            <span class="material-symbols-outlined nav-arrow">expand_more</span>
                        </button>
                        <ul class="submenu">
                            <?php foreach ($klasifikasi_segments as $segment): ?>
                                <?php
                                $label = str_replace('master', 'Master ', $segment);
                                $label = ucwords(str_replace('_', ' ', $label));
                                ?>
                                <li>
                                    <a href="<?= site_url($segment) ?>" class="nav-link <?= $uri->getSegment(1) == $segment ? 'active' : '' ?>">
                                        <?= $label ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="sidebar-heading">Fasilitas</div>
                    <a href="#" class="nav-link">
                        <span class="material-symbols-outlined nav-icon">security</span>
                        <span class="nav-text">Otoritas</span>
                    </a>
                    <a href="<?= site_url('batas-tanggal') ?>" class="nav-link <?= $uri->getSegment(1) == 'batas-tanggal' ? 'active' : '' ?>">
                        <span class="material-symbols-outlined nav-icon">date_range</span>
                        <span class="nav-text">Batas Tanggal</span>
                    </a>
                <?php endif; ?>
            </nav>
        </aside>

        <!-- Header -->
        <header class="main-header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <!-- Tombol ini hanya muncul di mobile -->
                <button class="icon-button menu-toggle" id="menu-toggle">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <!-- Tombol ini hanya muncul di desktop -->
                <button class="icon-button sidebar-toggle" id="sidebar-toggle">
                    <span class="material-symbols-outlined">menu_open</span>
                </button>
            </div>
            <div class="header-user-info">
                <span><?= esc(session()->get('user_nama')) ?></span>
                <button id="darkmode-toggle" class="btn-m3 btn-m3-sm btn-secondary-m3" title="Dark Mode" style="margin-right:8px;">
                    <span class="material-symbols-outlined" style="font-size:1rem;vertical-align:middle;">dark_mode</span>
                </button>
                <a href="<?= site_url('logout') ?>" class="btn-m3 btn-danger-m3 btn-m3-sm" style="vertical-align:middle;">
                    <span class="material-symbols-outlined" style="font-size: 1rem;">logout</span>
                    Logout
                </a>
            </div>
        </header>

        <!-- Konten Utama -->
        <main class="main-content">
            <div class="content-card">
                <?= $this->renderSection('content') ?>
            </div>
            <footer class="footer">
                &copy; <?= date('Y') ?> Web Admin. All rights reserved.
            </footer>
        </main>
    </div>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            const layoutContainer = document.getElementById('layout-container');
            const menuToggle = document.getElementById('menu-toggle'); // Tombol mobile
            const sidebarToggle = document.getElementById('sidebar-toggle'); // Tombol desktop
            const overlay = document.getElementById('sidebar-overlay');

            // --- Terapkan preferensi darkmode dari localStorage saat halaman dimuat ---
            if (localStorage.getItem('themeMode') === 'dark') {
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
            }

            // --- Fungsi Ciutkan/Buka Sidebar di Desktop ---
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', () => {
                    layoutContainer.classList.toggle('collapsed');
                    if (layoutContainer.classList.contains('collapsed')) {
                        document.querySelectorAll('.has-sub').forEach(el => el.classList.remove('open'));
                    }
                });
            }

            // --- Fungsi Buka/Tutup Sidebar di Mobile ---
            function toggleMobileSidebar() {
                body.classList.toggle('sidebar-open');
            }
            if (menuToggle) {
                menuToggle.addEventListener('click', toggleMobileSidebar);
            }
            if (overlay) {
                overlay.addEventListener('click', toggleMobileSidebar);
            }

            // --- Fungsi Dropdown Menu ---
            document.querySelectorAll('.nav-toggle').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    const parent = toggle.closest('.has-sub');
                    if (layoutContainer.classList.contains('collapsed')) {
                        layoutContainer.classList.remove('collapsed');
                        document.querySelectorAll('.has-sub').forEach(el => el.classList.remove('open'));
                        parent.classList.add('open');
                        e.stopPropagation();
                        return;
                    }
                    parent.classList.toggle('open');
                });
            });

            // --- Darkmode Toggle ---
            const darkmodeToggle = document.getElementById('darkmode-toggle');
            if (darkmodeToggle) {
                darkmodeToggle.addEventListener('click', function() {
                    const isDark = body.classList.toggle('dark-mode');
                    localStorage.setItem('themeMode', isDark ? 'dark' : 'light');
                });
            }
        });
    </script>
    <!-- Bootstrap 5 JS Bundle (with Popper) -->
    <script src="/assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Flatpickr (Date Picker) JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>

</html>