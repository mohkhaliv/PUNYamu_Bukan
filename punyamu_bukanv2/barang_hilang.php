<?php include 'header.php'; include 'db.php'; ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Barang Hilang</h2>
        <a href="lapor.php?type=lost" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Laporkan Barang Hilang
        </a>
    </div>
    
    <?php
    // Check if there are any lost items
    $stmt = $pdo->query("SELECT * FROM reports WHERE type = 'lost' AND status = 'verified' ORDER BY created_at DESC");
    if ($stmt->rowCount() > 0): ?>
        <div class="row">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if ($row['image']): ?>
                            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="card-text text-muted">
                                <i class="fas fa-map-marker-alt me-2"></i><?= htmlspecialchars($row['location']) ?>
                            </p>
                            <div class="card-text flex-grow-1" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.5em;">
                                <?= htmlspecialchars($row['description']) ?>
                            </div>
                            <div class="mt-auto">
                                <a href="detail_barang.php?id=<?= $row['report_id'] ?>" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-info-circle me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    <?= date('d M Y', strtotime($row['date_reported'])) ?>
                                </small>
                                <small class="text-muted">
                                    <i class="far fa-clock me-1"></i>
                                    <?= date('H:i', strtotime($row['time_reported'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="bg-light rounded p-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h3>Belum ada laporan barang hilang</h3>
                <p class="text-muted">Jadilah yang pertama melaporkan barang hilang Anda.</p>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
