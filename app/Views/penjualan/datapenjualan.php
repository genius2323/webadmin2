<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-header-m3 d-flex align-items-center mb-3" style="gap:1rem;">
    <span class="material-symbols-rounded page-header-icon-m3" style="font-size:2.2rem;color:#1976d2;">receipt_long</span>
    <div>
        <h2 class="page-title-m3 mb-0">Data Penjualan</h2>
        <div class="page-subtitle-m3" style="font-size:1rem;color:#666;margin-bottom:0;">Daftar seluruh transaksi penjualan.</div>
    </div>
    <div class="flex-grow-1"></div>
    <?php if (isset($canCreate) ? $canCreate : true): ?>
        <a href="<?= site_url('penjualan') ?>" class="btn-m3 btn-primary-m3">
            <span class="material-symbols-rounded align-middle">add</span> Buat Nota Baru
        </a>
    <?php endif; ?>
</div>
<div class="card-m3">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-m3 alert-m3-success mb-3 text-center">
            <span class="material-symbols-rounded align-middle">check_circle</span>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <form method="get" action="" class="form-search-m3 mb-3">
        <input type="text" name="keyword" class="input-m3" placeholder="Cari nomor nota/customer/sales..." value="<?= esc($_GET['keyword'] ?? '') ?>">
        <button type="submit" class="btn-m3 btn-secondary-m3 btn-m3-sm">Cari</button>
    </form>
    <div class="table-responsive-m3">
        <table class="table-m3">
            <thead>
                <tr>
                    <th class="text-center">Nomor Nota</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Sales</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penjualan as $row): ?>
                    <?php
                    $keyword = $_GET['keyword'] ?? '';
                    if ($keyword && stripos($row['nomor_nota'] . $row['customer'] . $row['sales'], $keyword) === false) continue;
                    $otoritas = $row['otoritas'] ?? 'T';
                    ?>
                    <tr>
                        <td class="text-center" style="white-space:nowrap;"><?= esc($row['nomor_nota']) ?></td>
                        <td class="text-center" style="white-space:nowrap;"><?= esc(date('d/m/Y', strtotime($row['tanggal_nota']))) ?></td>
                        <td class="text-center" style="white-space:nowrap;"><?= esc($row['customer']) ?></td>
                        <td class="text-center" style="white-space:nowrap;"><?= esc($row['sales']) ?></td>
                        <td class="text-center" style="white-space:nowrap;">Rp <?= number_format($row['grand_total'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <span class="badge-modern <?= $row['status'] == 'completed' ? 'badge-success-modern' : 'badge-warning-modern' ?>">
                                <?= esc(ucfirst($row['status'])) ?>
                            </span>
                        </td>
                        <td class="text-center" style="min-width:120px;display:flex;gap:6px;justify-content:center;align-items:center;">
                            <a href="<?= site_url('penjualan/detail/' . $row['id']) ?>" class="btn-m3 btn-secondary-m3 btn-m3-sm" title="Detail">
                                <span class="material-symbols-rounded align-middle">visibility</span>
                            </a>
                            <?php if ($otoritas === 'T'): ?>
                                <a href="<?= site_url('penjualan/edit/' . $row['id']) ?>" class="btn-m3 btn-warning-m3 btn-m3-sm" title="Edit">
                                    <span class="material-symbols-rounded align-middle">edit</span>
                                </a>
                                <a href="<?= site_url('penjualan/delete/' . $row['id']) ?>" class="btn-m3 btn-danger-m3 btn-m3-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini? Data akan dihapus (soft delete) di dua database.')">
                                    <span class="material-symbols-rounded align-middle">delete</span>
                                </a>
                            <?php else: ?>
                                <span class="btn-m3 btn-warning-m3 btn-m3-sm disabled" title="Tidak ada otoritas" style="pointer-events:none;opacity:0.6;">
                                    <span class="material-symbols-rounded align-middle">edit</span>
                                </span>
                                <span class="btn-m3 btn-danger-m3 btn-m3-sm disabled" title="Tidak ada otoritas" style="pointer-events:none;opacity:0.6;">
                                    <span class="material-symbols-rounded align-middle">delete</span>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Pager modern jika ada -->
    <?php if (isset($pager)) : ?>
        <div class="pager-m3 mt-3 d-flex justify-content-center">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>
<!-- Material 3 styles assumed to be globally included. -->
<?= $this->endSection(); ?>