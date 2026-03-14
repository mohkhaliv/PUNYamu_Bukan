<?php
// Include necessary files
include 'header.php';
include 'db.php';
?>

<!-- Hero Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <img src="assets/images/logo punyamu bukan.png" alt="PUNYamu Bukan?" class="img-fluid mb-3" style="max-height: 135px; width: auto;">
                <p class="lead mb-4">Sebuah inisiatif untuk saling membantu menemukan barang hilang di lingkungan Universitas Negeri Yogyakarta.</p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="lapor.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Laporkan Barang
                    </a>
                    <a href="barang_ditemukan.php" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-search me-2"></i>Cari Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-6 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Cara Kerja</h2>
            <p class="text-muted">Temukan atau laporkan barang hilang dengan mudah dalam 3 langkah sederhana</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin: 0 auto 1.5rem;">
                        <i class="fas fa-search fa-2x"></i>
                    </div>
                    <h3 class="h5">1. Cari Barang</h3>
                    <p class="text-muted">Periksa daftar barang temuan terbaru yang telah dilaporkan oleh warga UNY.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin: 0 auto 1.5rem;">
                        <i class="fas fa-edit fa-2x"></i>
                    </div>
                    <h3 class="h5">2. Laporkan</h3>
                    <p class="text-muted">Laporkan barang yang Anda temukan atau hilangkan dengan mengisi form laporan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin: 0 auto 1.5rem;">
                        <i class="fas fa-handshake fa-2x"></i>
                    </div>
                    <h3 class="h5">3. Klaim</h3>
                    <p class="text-muted">Klaim barang Anda yang hilang dengan menunjukkan bukti kepemilikan yang valid.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Items Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Barang Ditemukan Column -->
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0"><i class="fas fa-search me-2 text-success"></i>Barang Ditemukan</h3>
                    <a href="barang_ditemukan.php" class="btn btn-sm btn-outline-success">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <?php
                        $stmtFound = $pdo->query("SELECT * FROM reports WHERE status = 'verified' AND type = 'found' ORDER BY created_at DESC LIMIT 3");
                        if ($stmtFound->rowCount() > 0) {
                            while ($row = $stmtFound->fetch(PDO::FETCH_ASSOC)) {
                                echo '<a href="detail_barang.php?id=' . $row['report_id'] . '" class="text-decoration-none text-dark d-block">';
                                echo '<div class="p-3 border-bottom hover-lift">';
                                echo '<div class="d-flex">';
                                if ($row['image']) {
                                    echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">';
                                } else {
                                    echo '<div class="bg-light d-flex align-items-center justify-content-center rounded me-3" style="width: 80px; height: 80px;">';
                                    echo '<i class="fas fa-image text-muted"></i>';
                                    echo '</div>';
                                }
                                echo '<div class="flex-grow-1">';
                                echo '<div class="d-flex justify-content-between align-items-start">';
                                echo '<div>';
                                echo '<h6 class="mb-1">' . htmlspecialchars($row['title']) . '</h6>';
                                echo '<p class="small text-muted mb-1"><i class="fas fa-map-marker-alt me-1"></i>' . htmlspecialchars($row['location']) . '</p>';
                                echo '</div>';
                                echo '<div class="text-end">';
                                echo '<p class="small text-muted mb-1"><i class="far fa-calendar-alt me-1"></i>' . date('d M Y', strtotime($row['date_reported'])) . '</p>';
                                echo '<p class="small text-muted mb-0"><i class="far fa-clock me-1"></i>' . date('H:i', strtotime($row['time_reported'])) . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '<span class="badge bg-success bg-opacity-10 text-success small mt-2">Ditemukan</span>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</a>';
                            }
                        } else {
                            echo '<div class="text-center p-4">';
                            echo '<i class="fas fa-inbox fa-2x text-muted mb-2"></i>';
                            echo '<p class="text-muted mb-0">Belum ada laporan barang ditemukan</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Barang Hilang Column -->
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0"><i class="fas fa-question-circle me-2 text-danger"></i>Barang Hilang</h3>
                    <a href="barang_hilang.php" class="btn btn-sm btn-outline-danger">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <?php
                        $stmtLost = $pdo->query("SELECT * FROM reports WHERE status = 'verified' AND type = 'lost' ORDER BY created_at DESC LIMIT 3");
                        if ($stmtLost->rowCount() > 0) {
                            while ($row = $stmtLost->fetch(PDO::FETCH_ASSOC)) {
                                echo '<a href="detail_barang.php?id=' . $row['report_id'] . '" class="text-decoration-none text-dark d-block">';
                                echo '<div class="p-3 border-bottom hover-lift">';
                                echo '<div class="d-flex">';
                                if ($row['image']) {
                                    echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">';
                                } else {
                                    echo '<div class="bg-light d-flex align-items-center justify-content-center rounded me-3" style="width: 80px; height: 80px;">';
                                    echo '<i class="fas fa-image text-muted"></i>';
                                    echo '</div>';
                                }
                                echo '<div class="flex-grow-1">';
                                echo '<div class="d-flex justify-content-between align-items-start">';
                                echo '<div>';
                                echo '<h6 class="mb-1">' . htmlspecialchars($row['title']) . '</h6>';
                                echo '<p class="small text-muted mb-1"><i class="fas fa-map-marker-alt me-1"></i>' . htmlspecialchars($row['location']) . '</p>';
                                echo '</div>';
                                echo '<div class="text-end">';
                                echo '<p class="small text-muted mb-1"><i class="far fa-calendar-alt me-1"></i>' . date('d M Y', strtotime($row['date_reported'])) . '</p>';
                                echo '<p class="small text-muted mb-0"><i class="far fa-clock me-1"></i>' . date('H:i', strtotime($row['time_reported'])) . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '<span class="badge bg-danger bg-opacity-10 text-danger small mt-2">Hilang</span>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</a>';
                            }
                        } else {
                            echo '<div class="text-center p-4">';
                            echo '<i class="fas fa-inbox fa-2x text-muted mb-2"></i>';
                            echo '<p class="text-muted mb-0">Belum ada laporan barang hilang</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<style>
.hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    background-color: #f8f9fa;
    cursor: pointer;
}
</style>

<?php include 'footer.php'; ?>
