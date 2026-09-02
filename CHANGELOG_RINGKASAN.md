# Ringkasan Perubahan — Master Jenis Tanaman

Dokumen ini merangkum semua perubahan yang dilakukan pada file [`resources/views/master/jenis-tanaman/index.blade.php`](resources/views/master/jenis-tanaman/index.blade.php) selama sesi kerja.

---

## 1. Hapus Pewarnaan "Jenis Perbanyakan"

**Permintaan:** Konten "Jenis Perbanyakan" supaya tidak diberi warna-warna (badge), tampil plain.

**Perubahan:**

```php
// SEBELUM
{
    "data": "klasifikasi",
    "className": "text-center",
    "render": function (data, type, row) {
        var badgeClass = row.klasifikasi_badge || 'badge-secondary';
        return '<span class="badge ' + badgeClass + '">' + (data || '-') + '</span>';
    }
},

// SESUDAH
{
    "data": "klasifikasi",
    "className": "text-center",
    "render": function (data, type, row) {
        return (data || '-');
    }
},
```

Badge dihilangkan, isi tampil plain teks.

---

## 2. Refactor Checkbox "Pilih Semua" ke Card-Header

**Permintaan:** Checkbox `checkAll` di dalam `<th>` tabel terlihat kurang cocok; pindahkan ke card-header.

**Sebelum:** Checkbox ada di kolom `<th>` tabel.

**Sesudah:** Checkbox "Pilih Semua" dipindahkan ke `.card-tools` di card-header, dengan struktur AdminLTE 4 (custom-control custom-checkbox + label).

```html
<div class="custom-control custom-checkbox ml-2 d-flex align-items-center" title="Pilih Semua">
    <input type="checkbox" id="checkAll" class="custom-control-input">
    <label for="checkAll" class="custom-control-label"
           style="font-size: 0.85rem; font-weight: normal; margin-bottom: 0; cursor: pointer;">
        Pilih Semua
    </label>
</div>
```

**Tombol Hapus** juga diperbarui agar menampilkan counter pilihan:

```html
<button type="button" class="btn btn-danger btn-sm ml-1" onclick="hapusData()"
        disabled id="btnHapusMassal">
    <i class="fas fa-trash"></i> Hapus
    <span id="selectedCount" class="badge badge-light ml-1" style="display:none;"></span>
</button>
```

---

## 3. Hapus Checkbox Per-Baris

**Permintaan:** Checkbox `<input type="checkbox" class="checkItem">` di setiap baris dihapus.

**Perubahan:**

- Header `<th>` checkbox dihapus dari tabel.
- Render kolom "No" dikembalikan tampil nomor urut saja (tanpa checkbox vertikal di atasnya).
- Mekanisme pemilihan diganti dari checkbox → klik baris (`<tr>`) untuk toggle pilih.

**JS logic baru:**

```js
// Pilih semua (cross-page via DataTables rows)
$('#checkAll').on('change', function () {
    if (this.checked) {
        allSelected = true;
        table.rows().every(function () {
            selectedIds.add(String(this.data().id));
        });
    } else {
        allSelected = false;
        selectedIds.clear();
    }
    applyRowHighlight();
    syncBulkActionUI();
});

// Klik baris untuk toggle pilih individual
$('#jenisTanamanTable tbody').on('click', 'tr', function () {
    if (allSelected) return;
    var rowData = table.row(this).data();
    if (!rowData || !rowData.id) return;
    var id = String(rowData.id);
    if (selectedIds.has(id)) selectedIds.delete(id);
    else selectedIds.add(id);
    applyRowHighlight();
    syncBulkActionUI();
});
```

**CSS highlight baris terpilih:**

```css
#jenisTanamanTable tbody tr.table-selected {
    background-color: #cfe2ff !important;
    cursor: pointer;
}
```

---

## 4. Soft Color untuk Badge "Ya" dan "Tidak"

**Permintaan:** Warna badge "Ya" dan "Tidak" dibuat lebih soft dan elegan, tidak mencolok.

**Warna baru:**

| Status | Background | Text | Border |
|--------|------------|------|--------|
| Ya | `#dff3e1` | `#2e7d32` | `#c8e6c9` |
| Tidak | `#fde2e2` | `#c62828` | `#efcfcf` |

**CSS override (hanya untuk tabel ini):**

```css
#jenisTanamanTable .badge.badge-success {
    background-color: #dff3e1 !important;
    color: #2e7d32 !important;
    border: 1px solid #c8e6c9;
}
#jenisTanamanTable .badge.badge-danger {
    background-color: #fde2e2 !important;
    color: #c62828 !important;
    border: 1px solid #efcfcf;
}
```

Bentuk badge tetap (tidak diubah), hanya warna background dan text.

---

## 5. Fix Tabel Goyang Saat Horizontal Scroll

**Permasalahan:** Saat tabel di-scroll horizontal, garis vertikal antar kolom terlihat bergeser / tidak sejajar dengan header.

**Penyebab:**

- DataTables `scrollX: true` membuat wrapper scroll sendiri
- Inline `width="..."` di `<th>` bentrok dengan DataTables `width` JS setting
- Bootstrap `.table-responsive` + DataTables `scrollX` tumpang tindih

**Solusi (hanya CSS/HTML):**

1. **Wrapper scroll baru** (`.table-responsive-wrapper`):

```css
.table-responsive-wrapper {
    width: 100%;
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    border: 1px solid #dee2e6;
    border-radius: 4px;
}
```

2. **`table-layout: fixed`** — lebar kolom konsisten antara header & body.

3. **CSS column widths via `nth-child`** — menggantikan inline width attribute dan JS DataTables width.

```css
#jenisTanamanTable {
    width: 100% !important;
    table-layout: fixed;
    border-collapse: collapse !important;
    border-spacing: 0;
}
#jenisTanamanTable th,
#jenisTanamanTable td {
    box-sizing: border-box;
    border: 1px solid #dee2e6;
    word-wrap: break-word;
    overflow-wrap: break-word;
}
```

4. **DataTables:** `scrollX: false` + `autoWidth: false`.

**Hasil:** Tabel boleh bergerak saat scroll horizontal, tetapi border antar kolom tetap lurus dan presisi.

---

## 6. Perbesar Ukuran Teks Header Tabel

**Permintaan:** Judul kolom (`<thead>`) terlalu kecil; dibuat lebih besar dan tegas.

**Perubahan ( hanya `<th>`, tidak menyentuh `<td>`):**

```css
#jenisTanamanTable th {
    font-size: 14px !important;
    font-weight: 600 !important;
    color: #1f2d3d !important;
    letter-spacing: 0.2px;
    padding-top: 10px !important;
    padding-bottom: 10px !important;
    padding-left: 12px !important;
    padding-right: 12px !important;
    background-color: #f4f6f6 !important;
}
#jenisTanamanTable td {
    font-size: 0.85rem;  /* tetap */
}
```

`!important` digunakan agar DataTables / rule lain tidak override.

---

## 7. Perlebar Kolom Header (Judul Tidak Terpotong)

**Permintaan:** Lebar kolom terlalu sempit; judul kolom terpotong.

**Lebar kolom baru (total ~2480px):**

| # | Kolom | Sebelum | Sekarang |
|---|-------|---------|----------|
| 1 | No | 50px | 60px |
| 2 | Kode | 100px | 120px |
| 3 | Nama Tanaman | 180px | 220px |
| 4 | Jenis Perbanyakan | 120px | 150px |
| 5 | Nama Perbanyakan | 150px | 180px |
| 6 | Satuan Penangkaran | 120px | 170px |
| 7 | Satuan Produk | 100px | 130px |
| 8 | Satuan Ukuran | 100px | 140px |
| 9 | Pop. Pemeriksaan | 100px | 150px |
| 10 | Pop. Jantan | 100px | 130px |
| 11 | Pop. Betina | 100px | 130px |
| 12–36 | Kolom Ya/Tidak | 80px | 95px |
| Last | Aksi | 90px | 110px |

---

## 8. Penambahan Kolom "Golongan" — Dibatalkan

**Permintaan awal:** Tambah kolom "Golongan" setelah kolom "No" dan hapus kolom "Kode".

**Status:** Dibatalkan / tidak diteruskan karena:

- Tabel `jenis_tanaman` **tidak memiliki** kolom `golongan_id` atau relasi ke tabel `golongan`.
- Model [`app/Models/JenisTanaman.php`](app/Models/JenisTanaman.php) tidak memiliki relasi `golongan()`.
- Akan memerlukan perubahan schema (migration) dan backend.

---

## 9. Standardisasi Checkbox "Pilih Semua" Global — Dibatalkan

**Permintaan:** Standarkan tampilan checkbox "Pilih Semua" ke SELURUH halaman (8 file lain).

**Inventaris halaman dengan `#checkAll`:**

| # | File | Posisi |
|---|------|--------|
| 1 | resources/views/master/jenis-tanaman/index.blade.php | card-header (custom) |
| 2 | resources/views/sertifikasi/pasca_lapangan.blade.php | `<th>` tabel |
| 3 | resources/views/sertifikasi/konsep_label.blade.php | `<th>` tabel |
| 4 | resources/views/sertifikasi/pengajuan.blade.php | `<th>` tabel |
| 5 | resources/views/sertifikasi/konsep_label_standart.blade.php | `<th>` tabel |
| 6 | resources/views/master/komoditas/index.blade.php | `<th>` tabel |
| 7 | resources/views/master/kumpulan/index.blade.php | `<th>` tabel |
| 8 | resources/views/lab/uji_laboratorium/index.blade.php | `<th>` tabel |
| 9 | resources/views/lab/log/index.blade.php | `<th>` tabel |

**Pendekatan yang sempat diterapkan:**

- CSS global di [`resources/views/template/t_admin.blade.php`](resources/views/template/t_admin.blade.php) untuk ukuran checkbox 18×18px, accent-color biru/hijau, hover scale 1.1.
- JS auto-inject `<label for="checkAll">Pilih Semua</label>` di samping checkbox `<th>` yang belum punya label.

**Status:** Dibatalkan atas permintaan user. Template sudah di-**revert** ke kondisi semula. Tidak ada perubahan yang tersisa di [`resources/views/template/t_admin.blade.php`](resources/views/template/t_admin.blade.php).

---

## File yang Berubah (Akhir Sesi)

| File | Status | Perubahan Akhir |
|------|--------|-----------------|
| [`resources/views/master/jenis-tanaman/index.blade.php`](resources/views/master/jenis-tanaman/index.blade.php) | ✅ Dimodifikasi | Semua perubahan #1 sampai #7 |
| [`resources/views/template/t_admin.blade.php`](resources/views/template/t_admin.blade.php) | ✅ Reverted | Kembali ke kondisi sebelum task #9 |

**Yang TIDAK berubah:**

- Route
- Controller
- Model
- Migration / Database
- API
- 8 file blade lain yang memiliki `#checkAll`
- File backend manapun