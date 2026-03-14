<?php
// Only start a session if one hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is properly authenticated
if (!isset($_SESSION['admin']) || !isset($_SESSION['admin']['logged_in']) || $_SESSION['admin']['logged_in'] !== true) {
    // Clear any existing session data
    $_SESSION = array();
    
    // If it's desired to kill the session, also delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Finally, destroy the session
    session_destroy();
    
    header('Location: index.php');
    exit;
}

// Include database connection now that we know we need it
require_once '../db.php';

// --- START: ALL ACTION HANDLING LOGIC MOVED HERE ---

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit;
}

// Update last activity time
$_SESSION['admin']['last_activity'] = time();

// Handle report verification
if (isset($_GET['verify'])) {
    $id = $_GET['verify'];
    $stmt = $pdo->prepare("UPDATE reports SET status = 'verified' WHERE report_id = ?");
    $stmt->execute([$id]);
    $_SESSION['success'] = 'Laporan berhasil diverifikasi';
    header('Location: dashboard.php');
    exit;
}

// Handle marking report as completed or reverting to verified
if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    // Check current status to toggle between verified and selesai
    $stmt = $pdo->prepare("SELECT status FROM reports WHERE report_id = ?");
    $stmt->execute([$id]);
    $current_status = $stmt->fetch(PDO::FETCH_ASSOC)['status'];
    
    $new_status = ($current_status === 'selesai') ? 'verified' : 'selesai';
    $message = ($new_status === 'selesai') ? 'Laporan berhasil ditandai selesai' : 'Status laporan dikembalikan ke terverifikasi';
    
    $stmt = $pdo->prepare("UPDATE reports SET status = ? WHERE report_id = ?");
    $stmt->execute([$new_status, $id]);
    $_SESSION['success'] = $message;
    header('Location: dashboard.php');
    exit;
}

// Handle report deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("SELECT image FROM reports WHERE report_id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($item && $item['image'] && file_exists('../uploads/' . $item['image'])) {
        unlink('../uploads/' . $item['image']);
    }
    
    $stmt = $pdo->prepare("DELETE FROM reports WHERE report_id = ?");
    $stmt->execute([$id]);
    $_SESSION['success'] = 'Laporan berhasil dihapus';
    header('Location: dashboard.php');
    exit;
}

// Handle report update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_report'])) {
    $id = $_POST['report_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    $image = $_POST['existing_image'];
    
    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        if ($image && file_exists('../uploads/' . $image)) {
            unlink('../uploads/' . $image);
        }
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
    }
    
    $stmt = $pdo->prepare("UPDATE reports SET title = ?, description = ?, type = ?, location = ?, contact_info = ?, image = ? WHERE report_id = ?");
    $stmt->execute([$title, $description, $type, $location, $contact_info, $image, $id]);
    
    $_SESSION['success'] = 'Laporan berhasil diperbarui';
    header('Location: dashboard.php');
    exit;
}

// --- END: ACTION HANDLING ---


// --- START: PAGE RENDERING ---
// Now that all processing is done, we can start outputting the page.

// Set page title for the header
$page_title = 'Dashboard Admin';

// Include the header file, which starts printing HTML
require_once __DIR__ . '/includes/header.php';

// Get filter parameters
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Build the base query
$query = "SELECT * FROM reports WHERE 1=1";
$params = [];

// Add jenis filter if selected
if (!empty($jenis) && $jenis !== 'semua') {
    $query .= " AND type = ?";
    $params[] = $jenis;
}

// Add status filter if selected
if (!empty($status) && $status !== 'semua') {
    $query .= " AND status = ?";
    $params[] = $status;
}

// Add sorting
$query .= " ORDER BY created_at DESC";

// Prepare and execute the query
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get counts for dashboard cards with filters
$total_query = "SELECT COUNT(*) as total FROM reports WHERE 1=1";
$verified_query = "SELECT COUNT(*) as total FROM reports WHERE status = 'verified'";
$pending_query = "SELECT COUNT(*) as total FROM reports WHERE status = 'pending'";
$completed_query = "SELECT COUNT(*) as total FROM reports WHERE status = 'selesai'";

// Apply the same filters to the count queries
if (!empty($jenis) && $jenis !== 'semua') {
    $total_query .= " AND type = ?";
    $verified_query .= " AND type = ?";
    $pending_query .= " AND type = ?";
    $completed_query .= " AND type = ?";
}

// Execute total reports query
$stmt = $pdo->prepare($total_query);
if (!empty($jenis) && $jenis !== 'semua') {
    $stmt->execute([$jenis]);
} else {
    $stmt->execute();
}
$total_reports = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Execute verified reports query
$stmt = $pdo->prepare($verified_query);
if (!empty($jenis) && $jenis !== 'semua') {
    $stmt->execute([$jenis]);
} else {
    $stmt->execute();
}
$verified_reports = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Execute pending reports query
$stmt = $pdo->prepare($pending_query);
if (!empty($jenis) && $jenis !== 'semua') {
    $stmt->execute([$jenis]);
} else {
    $stmt->execute();
}
$pending_reports = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Execute completed reports query
$stmt = $pdo->prepare($completed_query);
if (!empty($jenis) && $jenis !== 'semua') {
    $stmt->execute([$jenis]);
} else {
    $stmt->execute();
}
$completed_reports = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
?>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card card-dashboard bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1">Total Laporan</h6>
                        <h2 class="mb-0"><?= number_format($total_reports) ?></h2>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-dashboard bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1">Selesai</h6>
                        <h2 class="mb-0"><?= number_format($completed_reports) ?></h2>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-check-double fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-dashboard bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1">Terverifikasi</h6>
                        <h2 class="mb-0"><?= number_format($verified_reports) ?></h2>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-dashboard bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1">Menunggu Verifikasi</h6>
                        <h2 class="mb-0"><?= number_format($pending_reports) ?></h2>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Laporan</h5>
        <div>
            <form action="" method="get" class="d-inline-flex gap-2">
                <select name="jenis" class="form-select form-select-sm" style="width: auto;">
                    <option value="semua" <?= (empty($jenis) || $jenis === 'semua') ? 'selected' : '' ?>>Semua Jenis</option>
                    <option value="lost" <?= $jenis === 'lost' ? 'selected' : '' ?>>Hilang</option>
                    <option value="found" <?= $jenis === 'found' ? 'selected' : '' ?>>Ditemukan</option>
                </select>
                <select name="status" class="form-select form-select-sm" style="width: auto;">
                    <option value="semua" <?= (empty($status) || $status === 'semua') ? 'selected' : '' ?>>Semua Status</option>
                    <option value="verified" <?= $status === 'verified' ? 'selected' : '' ?>>Terverifikasi</option>
                    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Menunggu</option>
                    <option value="selesai" <?= $status === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-sync-alt"></i>
                </a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Jenis</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($reports)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">Belum ada laporan</div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($reports as $report): ?>
                        <tr>
                            <td><?= $report['report_id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if ($report['image']): ?>
                                        <img src="../uploads/<?= htmlspecialchars($report['image']) ?>" alt="" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div>
                                        <div class="fw-medium"><?= htmlspecialchars($report['title']) ?></div>
                                        <small class="text-muted"><?= substr(htmlspecialchars($report['description']), 0, 30) ?>...</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-<?= $report['type'] == 'found' ? 'info' : 'primary' ?>">
                                    <?= $report['type'] == 'found' ? 'Ditemukan' : 'Hilang' ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($report['location']) ?></td>
                            <td><?= date('d M Y', strtotime($report['date_reported'])) ?></td>
                            <td>
                                <?php if ($report['status'] === 'verified'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                        Terverifikasi
                                    </span>
                                <?php elseif ($report['status'] === 'selesai'): ?>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                                        Selesai
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                        Menunggu
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($report['created_at'])) ?></td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $report['report_id'] ?>" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <?php if ($report['status'] === 'pending'): ?>
                                        <a href="?verify=<?= $report['report_id'] ?>" class="btn btn-sm btn-outline-success" title="Verifikasi">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($report['status'] === 'verified' || $report['status'] === 'selesai'): ?>
                                        <a href="?complete=<?= $report['report_id'] ?>" class="btn btn-sm btn-outline-<?= $report['status'] === 'selesai' ? 'warning' : 'info' ?>" 
                                           title="<?= $report['status'] === 'selesai' ? 'Kembalikan ke Terverifikasi' : 'Tandai Selesai' ?>">
                                            <i class="fas <?= $report['status'] === 'selesai' ? 'fa-undo' : 'fa-check-double' ?>"></i>
                                        </a>
                                    <?php endif; ?>
                                    <a href="?delete=<?= $report['report_id'] ?>" class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (!empty($reports)): ?>
    <?php foreach ($reports as $report): ?>
        <div class="modal fade" id="editModal<?= $report['report_id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="report_id" value="<?= $report['report_id'] ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($report['title']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis</label>
                                        <select name="type" class="form-select" required>
                                            <option value="lost" <?= $report['type'] == 'lost' ? 'selected' : '' ?>>Hilang</option>
                                            <option value="found" <?= $report['type'] == 'found' ? 'selected' : '' ?>>Ditemukan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($report['description']) ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lokasi</label>
                                        <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($report['location']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kontak</label>
                                        <input type="text" name="contact_info" class="form-control" value="<?= htmlspecialchars($report['contact_info']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <?php if ($report['image']): ?>
                                    <div class="mb-2">
                                        <img src="../uploads/<?= $report['image'] ?>" class="img-thumbnail" style="max-height: 150px;">
                                        <input type="hidden" name="existing_image" value="<?= $report['image'] ?>">
                                    </div>
                                <?php else: ?>
                                    <input type="hidden" name="existing_image" value="">
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="update_report" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php
// Include footer
include 'includes/footer.php';
?>