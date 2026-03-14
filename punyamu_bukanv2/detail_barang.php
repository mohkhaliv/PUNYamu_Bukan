<?php include 'header.php'; include 'db.php'; ?>
<style>
    .item-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .detail-card {
        background: #fff;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        height: 100%;
    }
    .detail-item {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .detail-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }
    .detail-value {
        color: #333;
    }
    .type-badge {
        font-size: 0.9rem;
        padding: 5px 15px;
        border-radius: 20px;
        margin-bottom: 20px;
        display: inline-block;
    }
    .type-lost {
        background-color: #ffebee;
        color: #c62828;
    }
    .type-found {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
</style>

<div class="container my-5">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM reports WHERE report_id = ? AND status = 'verified'");
        $stmt->execute([$id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($item) {
            $typeClass = $item['type'] == 'lost' ? 'type-lost' : 'type-found';
            $typeText = $item['type'] == 'lost' ? 'Barang Hilang' : 'Barang Ditemukan';
            ?>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <?php if (!empty($item['image'])) { ?>
                        <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" class="item-image" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    <?php } else { ?>
                        <div class="item-image d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-image fa-5x text-muted"></i>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <div class="detail-card">
                        <span class="type-badge <?php echo $typeClass; ?>">
                            <i class="fas fa-<?php echo $item['type'] == 'lost' ? 'search' : 'check-circle'; ?> me-1"></i>
                            <?php echo $typeText; ?>
                        </span>
                        <h2 class="mb-4"><?php echo htmlspecialchars($item['title']); ?></h2>
                        
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-align-left me-2"></i>Deskripsi</div>
                            <div class="detail-value"><?php echo nl2br(htmlspecialchars($item['description'])); ?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-map-marker-alt me-2"></i>Lokasi</div>
                            <div class="detail-value"><?php echo htmlspecialchars($item['location']); ?></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label"><i class="far fa-calendar-alt me-2"></i>Tanggal</div>
                                    <div class="detail-value"><?php echo date('d M Y', strtotime($item['date_reported'])); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label"><i class="far fa-clock me-2"></i>Waktu</div>
                                    <div class="detail-value"><?php echo date('H:i', strtotime($item['time_reported'])); ?> WIB</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-phone-alt me-2"></i>Kontak</div>
                            <div class="detail-value"><?php echo htmlspecialchars($item['contact_info']); ?></div>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-muted mb-3">Untuk proses klaim, silakan hubungi kontak yang tertera. Kami mohon kerja samanya untuk memberitahu kami apabila barang telah berhasil kembali kepada Anda.</p>
                            <a href="index.php" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo '<div class="alert alert-danger">Barang tidak ditemukan atau belum diverifikasi.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Tidak ada barang yang dipilih.</div>';
    }
    ?>
</div>
<?php include 'footer.php'; ?>
<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">