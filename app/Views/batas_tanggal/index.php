<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- Memuat library Material Web Components -->
<script type="module" src="https://esm.run/@material/web/all.js"></script>
<style>
    .form-container {
        max-width: 650px;
        margin: 0 auto;
    }


    .mode-selection {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 600px) {
        .mode-selection {
            grid-template-columns: 1fr;
        }
    }


    .mode-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        border: 2px solid var(--color-outline);
        border-radius: var(--border-radius-medium);
        cursor: pointer;
        transition: border-color var(--transition-speed-fast), background-color var(--transition-speed-fast), box-shadow 0.2s;
        position: relative;
        background: var(--color-surface);
        box-shadow: 0 1px 4px rgba(66, 133, 244, 0.04);
        user-select: none;
        touch-action: manipulation;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .mode-card:hover,
    .mode-card:focus-visible {
        background-color: var(--color-primary-container);
        border-color: var(--color-primary);
        box-shadow: 0 4px 16px rgba(66, 133, 244, 0.10);
        outline: none;
    }

    .mode-card.selected {
        border-color: var(--color-primary);
        background-color: var(--color-primary);
        color: var(--color-on-primary);
        box-shadow: 0 4px 16px rgba(66, 133, 244, 0.12);
    }

    .mode-card.selected .material-symbols-outlined,
    .mode-card.selected .mode-card-title,
    .mode-card.selected .mode-card-desc {
        color: var(--color-on-primary);
    }

    .mode-card:active {
        background-color: var(--color-primary-container);
        box-shadow: 0 2px 8px rgba(66, 133, 244, 0.08);
    }

    .mode-card .material-symbols-outlined {
        font-size: 28px;
        margin-bottom: 8px;
        color: var(--color-primary);
    }

    .mode-card-title {
        font-weight: 600;
        color: var(--color-on-surface);
    }

    .mode-card-desc {
        font-size: 0.875rem;
        color: var(--color-on-surface-variant);
    }

    .mode-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 32px;
    }

    /* Dropdown Material 3 style */
    .select-m3 {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid var(--color-outline);
        border-radius: var(--border-radius-medium);
        background: var(--color-surface);
        color: var(--color-on-surface);
        font-size: 1rem;
        font-family: var(--font-family);
        transition: border-color var(--transition-speed-fast), box-shadow var(--transition-speed-fast);
        appearance: none;
        outline: none;
        box-sizing: border-box;
        margin-bottom: 4px;
    }

    .select-m3:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 2px var(--color-primary-container);
    }

    .select-m3:disabled {
        background: var(--color-surface-bright);
        color: var(--color-on-surface-variant);
        opacity: 0.7;
    }

    .select-m3 option {
        color: var(--color-on-surface);
        background: var(--color-surface);
    }
</style>

<div class="form-container">
    <div class="page-header" style="display:flex;align-items:center;gap:16px;margin-left:24px;margin-bottom:18px;">
        <div class="page-header-icon" style="display:flex;align-items:center;">
            <span class="material-symbols-outlined" style="font-size:2.2rem;">verified_user</span>
        </div>
        <div>
            <h1 class="page-header-title" style="margin:0;">Batas Tanggal Sistem</h1>
            <p class="page-header-subtitle" style="margin:0;">Tingkatkan keamanan dengan mengatur batas waktu input transaksi.</p>
        </div>
    </div>
    <div class="content-card">
        <?php if (session('success')): ?>
            <div class="alert alert-success">
                <span class="material-symbols-outlined alert-icon">check_circle</span>
                <span><?= session('success') ?></span>
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('batas-tanggal/update') ?>" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?= esc($batas['id'] ?? '') ?>">

            <div class="form-group">
                <label for="menu" class="form-label">Pilih Menu Transaksi<span style="color:red">*</span></label>
                <select name="menu" id="menu" class="form-m3-input select-m3" required>
                    <option value="" disabled <?= empty($batas['menu']) ? 'selected' : '' ?>>-- Pilih Menu --</option>
                    <option value="penjualan" <?= ($batas['menu'] ?? '') == 'penjualan' ? 'selected' : '' ?>>Penjualan</option>
                    <option value="pembelian" <?= ($batas['menu'] ?? '') == 'pembelian' ? 'selected' : '' ?>>Pembelian</option>
                    <option value="jurnal" <?= ($batas['menu'] ?? '') == 'jurnal' ? 'selected' : '' ?>>Jurnal</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Pilih Mode Pengaturan</label>
                <div class="mode-selection">
                    <label class="mode-card" id="manual-card">
                        <input type="radio" name="mode" value="manual" <?= ($batas['mode_batas_tanggal'] ?? 'manual') == 'manual' ? 'checked' : '' ?>>
                        <span class="material-symbols-outlined">edit_calendar</span>
                        <span class="mode-card-title">Manual</span>
                        <span class="mode-card-desc">Atur Batas Tanggal</span>
                    </label>
                    <label class="mode-card" id="auto-card">
                        <input type="radio" name="mode" value="automatic" <?= ($batas['mode_batas_tanggal'] ?? '') == 'automatic' ? 'checked' : '' ?>>
                        <span class="material-symbols-outlined">autorenew</span>
                        <span class="mode-card-title">Otomatis</span>
                        <span class="mode-card-desc">H-2</span>
                    </label>
                </div>
            </div>

            <div class="form-group" id="tanggalBatasGroup">
                <label for="batas_tanggal" class="form-label">Tanggal Batas<span style="color:red">*</span></label>
                <div style="position: relative;">
                    <input
                        type="text"
                        name="batas_tanggal"
                        id="batas_tanggal"
                        class="form-m3-input input-m3-date"
                        value="<?= isset($batas['batas_tanggal']) ? date('d/m/Y', strtotime($batas['batas_tanggal'])) : date('d/m/Y') ?>"
                        required
                        autocomplete="off"
                        placeholder="Pilih tanggal batas">
                    <span class="material-symbols-outlined input-date-icon">calendar_today</span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-m3 btn-primary-m3">
                    <span class="material-symbols-outlined" style="vertical-align: middle;">save</span>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Flatpickr (Date Picker) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('#batas_tanggal', {
            dateFormat: 'd/m/Y',
            disableMobile: true,
            allowInput: false
        });

        // Tidak perlu JS untuk native select

        const manualRadio = document.querySelector('input[value="manual"]');
        const autoRadio = document.querySelector('input[value="automatic"]');
        const manualCard = document.getElementById('manual-card');
        const autoCard = document.getElementById('auto-card');
        const tanggalBatasGroup = document.getElementById('tanggalBatasGroup');

        function updateSelection() {
            if (manualRadio.checked) {
                manualCard.classList.add('selected');
                autoCard.classList.remove('selected');
                tanggalBatasGroup.style.display = 'block';
            } else {
                autoCard.classList.add('selected');
                manualCard.classList.remove('selected');
                tanggalBatasGroup.style.display = 'none';
            }
        }

        updateSelection();

        manualRadio.addEventListener('change', updateSelection);
        autoRadio.addEventListener('change', updateSelection);
    });
</script>

<?= $this->endSection() ?>