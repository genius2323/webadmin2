<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>


<!-- Material Design 3 Dialog Pilih Customer -->
<md-dialog id="modalCustomer">

  <style>
    body.dark-mode .modal-headline {
      color: #ffffffff !important;
      background-color: #18181b !important;
      /* hitam gelap, lebih gelap dari surface */
    }
  </style>
  <div slot="content" class="content-card">
    <h2 slot="headline" class="modal-headline" style="color:#7c3aed;">Pilih Customer</h2>
    <style>
      body.dark-mode .modal-headline {
        color: #ffffffff !important;
        /* hitam gelap, lebih gelap dari surface */
      }
    </style>
    <input type="text" id="searchCustomer" class="form-m3-input" placeholder="Cari Customer..." style="margin-bottom:16px;">
    <div style="max-height:400px;overflow:auto;">
      <table class="table-m3" style="width:100%;">
        <thead>
          <tr>
            <th style="text-align: center;">Kode</th>
            <th style="text-align: center;">Nama</th>
            <th style="text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableCustomerModal">
          <?php foreach ($customers as $row): ?>
            <tr>
              <td><?= esc($row['kode_customer']) ?></td>
              <td><?= esc($row['nama_customer']) ?></td>
              <td>
                <button type="button" class="pilih-customer-btn btn-m3 btn-primary-m3" data-kode="<?= esc($row['kode_customer']) ?>" data-nama="<?= esc($row['nama_customer']) ?>" style="display:flex;align-items:center;justify-content:center;gap:8px;padding:12px 24px;margin-bottom:8px;width:100%;">
                  <span class="material-symbols-outlined" style="font-size:20px;">check</span> <span style="font-weight:600;">Pilih</span>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</md-dialog>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Filter customer
    var searchCustomer = document.getElementById('searchCustomer');
    if (searchCustomer) {
      searchCustomer.addEventListener('input', function() {
        var filter = searchCustomer.value.toLowerCase();
        var rows = document.querySelectorAll('#tableCustomerModal tbody tr');
        rows.forEach(function(row) {
          var nama = row.cells[1].textContent.toLowerCase();
          var kode = row.cells[0].textContent.toLowerCase();
          row.style.display = (nama.indexOf(filter) > -1 || kode.indexOf(filter) > -1) ? '' : 'none';
        });
      });
    }

    // Pilih customer (Material Dialog)
    document.querySelectorAll('.pilih-customer-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var kode = btn.getAttribute('data-kode');
        var nama = btn.getAttribute('data-nama');
        var input = document.getElementById('customerInput');
        if (input) input.value = kode + ' - ' + nama;
        const dialog = document.getElementById('modalCustomer');
        if (dialog) dialog.close();
      });
    });

    // Open customer dialog
    var openCustomerBtn = document.querySelector('[data-md-dialog-open="modalCustomer"]');
    if (openCustomerBtn) {
      openCustomerBtn.addEventListener('click', function() {
        const dialog = document.getElementById('modalCustomer');
        if (dialog) dialog.show();
      });
    }

    // Filter sales
    var searchSales = document.getElementById('searchSales');
    if (searchSales) {
      searchSales.addEventListener('input', function() {
        var filter = searchSales.value.toLowerCase();
        var rows = document.querySelectorAll('#tableSalesModal tbody tr');
        rows.forEach(function(row) {
          var nama = row.cells[1].textContent.toLowerCase();
          var kode = row.cells[0].textContent.toLowerCase();
          row.style.display = (nama.indexOf(filter) > -1 || kode.indexOf(filter) > -1) ? '' : 'none';
        });
      });
    }

    // Pilih sales (Material Dialog)
    document.querySelectorAll('.pilih-sales-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var kode = btn.getAttribute('data-kode');
        var nama = btn.getAttribute('data-nama');
        var input = document.getElementById('salesInput');
        if (input) input.value = kode + ' - ' + nama;
        const dialog = document.getElementById('modalSales');
        if (dialog) dialog.close();
      });
    });

    // Open sales dialog
    var openSalesBtn = document.querySelector('[data-md-dialog-open="modalSales"]');
    if (openSalesBtn) {
      openSalesBtn.addEventListener('click', function() {
        const dialog = document.getElementById('modalSales');
        if (dialog) dialog.show();
      });
    }
  });
</script>
<!-- Memuat library Material Web Components -->
<script type="module" src="https://esm.run/@material/web/all.js"></script>
<style>
  .modal-headline {
    font-family: 'Inter', Arial, sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--color-on-surface, #222);
    margin-bottom: 8px;
  }

  .modal-content-template {
    font-family: 'Inter', Arial, sans-serif;
    color: var(--color-on-surface, #222);
    padding: 0;
  }

  .modal-search {
    width: 100%;
    margin-bottom: 16px;
    font-family: 'Inter', Arial, sans-serif;
  }

  .modal-table-scroll {
    max-height: 400px;
    overflow: auto;
  }

  .modal-table-template {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Inter', Arial, sans-serif;
    background: var(--color-surface, #fff);
  }

  .modal-table-template th {
    font-family: 'Inter', Arial, sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: var(--color-on-surface, #222);
    background: var(--color-primary-container, #f5f5f5);
    padding: 8px 12px;
    border-bottom: 1px solid #e0e0e0;
    text-align: left;
  }

  .modal-table-template td {
    font-family: 'Inter', Arial, sans-serif;
    font-size: 1rem;
    color: var(--color-on-surface, #222);
    padding: 8px 12px;
    border-bottom: 1px solid #f0f0f0;
  }

  .modal-btn-template {
    font-family: 'Inter', Arial, sans-serif;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.01em;
    color: var(--color-primary, #2962ff);
    background: var(--color-primary-container, #e3f2fd);
    border-radius: 8px;
    padding: 8px 18px;
    min-width: 100px;
    box-shadow: none;
    transition: background 0.2s;
  }

  .modal-btn-template:hover {
    background: var(--color-primary, #2962ff);
    color: var(--color-on-primary, #fff);
  }
</style>

<div class="form-container">

  <?= $this->extend('layout/template') ?>
  <?= $this->section('content') ?>
  <!-- Memuat library Material Web Components -->
  <script type="module" src="https://esm.run/@material/web/all.js"></script>
  <style>
    .form-container {
      max-width: 650px;
      margin: 0 auto;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      margin-top: 32px;
    }

    .form-m3-input {
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

    .form-m3-input:focus {
      border-color: var(--color-primary);
      box-shadow: 0 0 0 2px var(--color-primary-container);
    }

    .btn-m3.btn-primary-m3 {
      min-width: 140px;
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--color-primary);
      color: var(--color-on-primary);
      border: none;
      border-radius: var(--border-radius-medium);
      font-weight: 600;
      font-size: 1rem;
      padding: 12px 24px;
      cursor: pointer;
      transition: background 0.2s, box-shadow 0.2s;
      box-shadow: 0 1px 4px rgba(66, 133, 244, 0.04);
    }

    .btn-m3.btn-primary-m3:hover {
      background: var(--color-primary-container);
      color: var(--color-primary);
      box-shadow: 0 4px 16px rgba(66, 133, 244, 0.10);
    }
  </style>

  <div class="form-container">
    <div class="page-header" style="display:flex;align-items:center;gap:16px;margin-left:24px;margin-bottom:18px;">
      <div class="page-header-icon" style="display:flex;align-items:center;">
        <span class="material-symbols-outlined" style="font-size:2.2rem;">shopping_cart</span>
      </div>
      <div>
        <h1 class="page-header-title" style="margin:0;">Tambah Penjualan</h1>
        <p class="page-header-subtitle" style="margin:0;">Input transaksi penjualan dengan tampilan modern.</p>
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
      <?php if (session('error')): ?>
        <div class="alert alert-danger">
          <span class="material-symbols-outlined alert-icon">error</span>
          <span><?= session('error') ?></span>
          <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
      <?php endif; ?>
      <?php if (session('errors')): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach (session('errors') as $err): ?>
              <li><?= esc($err) ?></li>
            <?php endforeach; ?>
          </ul>
          <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
      <?php endif; ?>
      <form action="<?= base_url('penjualan/create') ?>" method="post" autocomplete="off">
        <div class="form-group">
          <label for="tanggal_nota" class="form-label">Tanggal Nota<span style="color:red">*</span></label>
          <div style="position: relative;">
            <input
              type="text"
              name="tanggal_nota"
              id="tanggal_nota"
              class="form-m3-input input-m3-date"
              value="<?= (isset($penjualan) && isset($penjualan['tanggal_nota'])) ? date('d/m/Y', strtotime($penjualan['tanggal_nota'])) : date('d/m/Y') ?>"
              required
              autocomplete="off"
              placeholder="Pilih tanggal nota">
            <span class="material-symbols-outlined input-date-icon">calendar_today</span>
          </div>
        </div>
        <div class="form-group">
          <label for="nomor_nota" class="form-label">Nomor Nota</label>
          <input type="text" class="form-m3-input" id="nomor_nota" name="nomor_nota" value="<?= esc($nomor_nota ?? '') ?>" readonly>
        </div>
        <div class="form-group">
          <label for="customer" class="form-label">Customer</label>
          <div style="display: flex; gap: 8px; align-items: center;">
            <input type="text" class="form-m3-input" id="customerInput" name="customer" readonly style="flex:1;">
            <button type="button" class="btn-m3 btn-primary-m3" data-md-dialog-open="modalCustomer">
              <span class="material-symbols-outlined">person_search</span> Pilih Customer
            </button>
          </div>
        </div>
        <div class="form-group">
          <label for="sales" class="form-label">Sales</label>
          <div style="display: flex; gap: 8px; align-items: center;">
            <input type="text" class="form-m3-input" id="salesInput" name="sales" readonly style="flex:1;">
            <button type="button" class="btn-m3 btn-primary-m3" data-md-dialog-open="modalSales">
              <span class="material-symbols-outlined">person_search</span> Pilih Sales
            </button>
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      flatpickr('#tanggal_nota', {
        dateFormat: 'd/m/Y',
        disableMobile: true,
        allowInput: false,
        minDate: <?= isset($batas_tanggal_sistem) && $batas_tanggal_sistem ? "'" . date('d/m/Y', strtotime($batas_tanggal_sistem)) . "'" : 'null' ?>,
        maxDate: 'today'
      });
    });
  </script>
  <?= $this->endSection() ?>
  </tbody>
  </table>
</div>
</div>

</div>
</div>
</div>

<!-- Material Design 3 Dialog Pilih Customer -->
<md-dialog id="modalCustomer">
  <div slot="headline">Pilih Customer</div>
  <div slot="content">
    <md-outlined-text-field id="searchCustomer" label="Cari Customer" style="width:100%;margin-bottom:16px;"></md-outlined-text-field>
    <div style="max-height:400px;overflow:auto;">
      <table style="width:100%;border-collapse:collapse;">
        <thead>
          <tr>
            <th style="text-align:left;">Kode</th>
            <th style="text-align:left;">Nama</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableCustomerModal">
          <?php foreach ($customers as $row): ?>
            <tr>
              <td><?= esc($row['kode_customer']) ?></td>
              <td><?= esc($row['nama_customer']) ?></td>
              <td style="text-align:center;">
                <md-filled-tonal-button class="pilih-customer-btn" data-kode="<?= esc($row['kode_customer']) ?>" data-nama="<?= esc($row['nama_customer']) ?>">
                  <span class="material-symbols-outlined" style="font-size:16px;vertical-align:middle;">check</span> Pilih
                </md-filled-tonal-button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div slot="actions">
    <md-text-button dialogAction="close">Tutup</md-text-button>
  </div>
</md-dialog>
<!-- Material Design 3 Dialog Pilih Sales -->
<md-dialog id="modalSales">
  <div slot="content" class="content-card">
    <h2 slot="headline" class="modal-headline">Pilih Sales</h2>
    <input type="text" id="searchSales" class="form-m3-input" placeholder="Cari Sales..." style="margin-bottom:16px;">
    <div style="max-height:400px;overflow:auto;">
      <table class="table-m3" style="width:100%;">
        <thead>
          <tr>
            <th style="text-align: center;">Kode</th>
            <th style="text-align: center;">Nama</th>
            <th style="text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody id="tableSalesModal">
          <?php foreach ($sales as $row): ?>
            <tr>
              <td><?= esc($row['kode']) ?></td>
              <td><?= esc($row['nama']) ?></td>
              <td>
                <button type="button" class="pilih-sales-btn btn-m3 btn-primary-m3" data-kode="<?= esc($row['kode']) ?>" data-nama="<?= esc($row['nama']) ?>" style="display:flex;align-items:center;justify-content:center;gap:8px;padding:12px 24px;margin-bottom:8px;width:100%;">
                  <span class="material-symbols-outlined" style="font-size:20px;">check</span> <span style="font-weight:600;">Pilih</span>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</md-dialog>
</div>

</script>


</div>

<script>
  $(document).ready(function() {
    // Modal Customer
    function filterCustomer(keyword = '') {
      $('#tableCustomerModal tbody tr').each(function() {
        var nama = $(this).find('td:nth-child(2)').text().toLowerCase();
        var kode = $(this).find('td:nth-child(1)').text().toLowerCase();
        if (nama.indexOf(keyword.toLowerCase()) !== -1 || kode.indexOf(keyword.toLowerCase()) !== -1) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
    $('#searchCustomer').on('input', function() {
      filterCustomer($(this).val());
    });
    $(document.body).on('click', '.pilih-customer-btn', function() {
      var kode = $(this).data('kode');
      var nama = $(this).data('nama');
      $('#customerInput').val(kode + ' - ' + nama);
      $('#modalCustomer').modal('hide');
    });

    // Modal Sales
    function filterSales(keyword = '') {
      $('#tableSalesModal tbody tr').each(function() {
        var nama = $(this).find('td:nth-child(2)').text().toLowerCase();
        var kode = $(this).find('td:nth-child(1)').text().toLowerCase();
        if (nama.indexOf(keyword.toLowerCase()) !== -1 || kode.indexOf(keyword.toLowerCase()) !== -1) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    }
    $('#searchSales').on('input', function() {
      filterSales($(this).val());
    });
    $(document.body).on('click', '.pilih-sales-btn', function() {
      var kode = $(this).data('kode');
      var nama = $(this).data('nama');
      $('#salesInput').val(kode + ' - ' + nama);
      $('#modalSales').modal('hide');
    });
  });
</script>
<script>
  // Search filter Customer
  document.addEventListener('DOMContentLoaded', function() {
    var searchCustomer = document.getElementById('searchCustomer');
    if (searchCustomer) {
      searchCustomer.addEventListener('input', function() {
        var filter = searchCustomer.value.toLowerCase();
        var rows = document.querySelectorAll('#tableCustomerModal tbody tr');
        rows.forEach(function(row) {
          var nama = row.cells[1].textContent.toLowerCase();
          var kode = row.cells[0].textContent.toLowerCase();
          row.style.display = (nama.indexOf(filter) > -1 || kode.indexOf(filter) > -1) ? '' : 'none';
        });
      });
    }
    // Pilih Customer
    document.body.addEventListener('click', function(e) {
      if (e.target.classList.contains('pilih-customer-btn')) {
        var kode = e.target.getAttribute('data-kode');
        var nama = e.target.getAttribute('data-nama');
        var input = document.getElementById('customerInput');
        if (input) input.value = kode + ' - ' + nama;
        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCustomer'));
        modal.hide();
      }
    });
    // Search filter Sales
    var searchSales = document.getElementById('searchSales');
    if (searchSales) {
      searchSales.addEventListener('input', function() {
        var filter = searchSales.value.toLowerCase();
        var rows = document.querySelectorAll('#tableSalesModal tbody tr');
        rows.forEach(function(row) {
          var nama = row.cells[1].textContent.toLowerCase();
          var kode = row.cells[0].textContent.toLowerCase();
          row.style.display = (nama.indexOf(filter) > -1 || kode.indexOf(filter) > -1) ? '' : 'none';
        });
      });
    }
    // Pilih Sales
    document.body.addEventListener('click', function(e) {
      if (e.target.classList.contains('pilih-sales-btn')) {
        var kode = e.target.getAttribute('data-kode');
        var nama = e.target.getAttribute('data-nama');
        var input = document.getElementById('salesInput');
        if (input) input.value = kode + ' - ' + nama;
        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalSales'));
        modal.hide();
      }
    });
  });
</script>
<!-- Modal Pilih Customer -->
<div class="modal fade" id="modalCustomer" tabindex="-1" aria-labelledby="modalCustomerLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCustomerLabel">Pilih Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customers as $row): ?>
              <tr>
                <td><?= esc($row['kode_customer']) ?></td>
                <td><?= esc($row['nama_customer']) ?></td>
                <td><button type="button" class="btn btn-success btn-sm" onclick="pilihCustomer('<?= esc($row['kode_customer']) ?>', '<?= esc($row['nama_customer']) ?>')">Pilih</button></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Pilih Sales -->
<div class="modal fade" id="modalSales" tabindex="-1" aria-labelledby="modalSalesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSalesLabel">Pilih Sales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $row): ?>
              <tr>
                <td><?= esc($row['kode']) ?></td>
                <td><?= esc($row['nama']) ?></td>
                <td><button type="button" class="btn btn-success btn-sm" onclick="pilihSales('<?= esc($row['kode']) ?>', '<?= esc($row['nama']) ?>')">Pilih</button></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  function pilihCustomer(kode, nama) {
    document.getElementById('customer').value = kode + ' - ' + nama;
    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCustomer'));
    modal.hide();
  }

  function pilihSales(kode, nama) {
    document.getElementById('sales').value = kode + ' - ' + nama;
    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalSales'));
    modal.hide();
  }
</script>
<!-- pastikan form ditutup di sini, lalu tutup semua div yang dibuka di atas -->
</div>
</div>
</div>
<?= $this->endSection() ?>