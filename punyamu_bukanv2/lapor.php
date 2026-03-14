<?php include 'header.php'; include 'db.php'; ?>
<div class="container my-5">
    <h2>Lapor Barang Hilang atau Ditemukan</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $location = $_POST['location'];
        $contact_info = $_POST['contact_info'];
        $date_reported = $_POST['date_reported'];
        $time_reported = $_POST['time_reported'];
        $image = '';
        if ($_FILES['image']['name']) {
            $image = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        }
        $created_at = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare("INSERT INTO reports (title, description, type, location, date_reported, time_reported, contact_info, image, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?)");
        $stmt->execute([$title, $description, $type, $location, $date_reported, $time_reported, $contact_info, $image, $created_at]);
        echo '<div class="alert alert-success">Laporan berhasil dikirim! Menunggu verifikasi admin.<br>Jika barang Anda kembali sebelum laporan ini terbit, harap segera hubungi kami.</div>';
    }
    ?>
    <form method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipe</label>
            <select name="type" class="form-control" required>
                <option value="lost">Hilang</option>
                <option value="found">Ditemukan</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kontak (Email/No. Telepon)</label>
            <input type="text" name="contact_info" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Kejadian</label>
            <input type="date" name="date_reported" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
            <small class="text-muted">Pilih tanggal saat barang hilang/ditemukan</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu Kejadian</label>
            <input type="time" name="time_reported" class="form-control" required>
            <small class="text-muted">Pilih waktu saat barang hilang/ditemukan</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Barang (Opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
    </form>
</div>
<?php include 'footer.php'; ?>