<?php
$page_title = 'FAQ - PUNYamu Bukan?';
include 'header.php';
?>

<main class="main-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
                
                <div class="text-center mb-5">
                    <h1 class="h2 mb-3">Pertanyaan yang Sering Diajukan</h1>
                    <p class="lead text-muted">Temukan jawaban atas pertanyaan umum seputar layanan PUNYamu Bukan?</p>
                </div>
                
                <div class="accordion" id="faqAccordion">
                    <!-- Umum -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-start d-flex justify-content-between align-items-center text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Apa itu PUNYamu Bukan?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="card-body">
                                PUNYamu Bukan? adalah platform digital untuk melaporkan dan menemukan barang hilang di lingkungan Universitas Negeri Yogyakarta. Kami mempertemukan penemu dan pencari barang yang hilang dalam satu wadah yang mudah diakses.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cara Melapor -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-start d-flex justify-content-between align-items-center text-decoration-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>Bagaimana cara melaporkan barang hilang?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="card-body">
                                <ol>
                                    <li>Klik tombol "Laporkan Barang" di menu atau halaman beranda</li>
                                    <li>Isi formulir laporan dengan informasi yang diminta</li>
                                    <li>Unggah foto barang (jika ada)</li>
                                    <li>Klik "Kirim Laporan"</li>
                                    <li>Tunggu konfirmasi dari admin</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Barang Ditemukan -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-start d-flex justify-content-between align-items-center text-decoration-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span>Apa yang harus saya lakukan jika menemukan barang?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="card-body">
                                <ol>
                                    <li>Laporkan melalui website kami dengan mengisi formulir "Laporkan Barang Ditemukan"</li>
                                    <li>Sertakan deskripsi detail dan foto barang</li>
                                    <li>Berikan informasi kontak yang bisa dihubungi</li>
                                    <li>Simpan barang dengan aman sambil menunggu klaim dari pemilik</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Waktu Proses -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white" id="headingFive">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-start d-flex justify-content-between align-items-center text-decoration-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <span>Berapa lama waktu yang dibutuhkan untuk memproses laporan saya?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="card-body">
                                <p>Proses verifikasi laporan biasanya memakan waktu 1-2 hari kerja. Setelah diverifikasi, laporan Anda akan segera ditampilkan di situs. Jika ada kecocokan dengan laporan yang ada, tim kami akan menghubungi Anda secepatnya.</p>
                                <p class="mb-0">Untuk keadaan darurat atau barang berharga tinggi, silakan hubungi nomor darurat yang tersedia.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Biaya -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white" id="headingSix">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-start d-flex justify-content-between align-items-center text-decoration-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <span>Apakah ada biaya untuk menggunakan layanan ini?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                            <div class="card-body">
                                Layanan PUNYamu Bukan? sepenuhnya gratis. Kami tidak memungut biaya apapun untuk pelaporan, pencarian, atau pengembalian barang. Waspadalah terhadap pihak yang mengatasnamakan kami dan meminta biaya.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Keamanan Data -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white" id="headingSeven">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-start d-flex justify-content-between align-items-center text-decoration-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    <span>Bagaimana keamanan data pribadi saya?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                            <div class="card-body">
                                <p>Kami sangat menjaga kerahasiaan data pribadi Anda:</p>
                                <ul>
                                    <li>Data disimpan di server yang aman dengan enkripsi</li>
                                    <li>Hanya petugas berwenang yang dapat mengakses data pribadi</li>
                                    <li>Informasi kontak hanya dibagikan dengan pihak yang berkepentingan</li>
                                    <li>Kami tidak menjual atau menyewakan data pribadi kepada pihak ketiga</li>
                                </ul>
                                <p class="mb-0">Baca selengkapnya di <a href="kebijakan_privasi.php">Kebijakan Privasi</a> kami.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barang Tidak Ditemukan -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white" id="headingEight">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-start d-flex justify-content-between align-items-center text-decoration-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    <span>Bagaimana jika barang saya tidak kunjung ditemukan?</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                            <div class="card-body">
                                <p>Jika barang Anda belum ditemukan dalam waktu 30 hari, kami sarankan untuk:</p>
                                <ol>
                                    <li>Memperbarui deskripsi barang dengan informasi tambahan. Hubungi admin untuk memproses pembaruan</li>
                                    <li>Memeriksa secara berkala di daftar barang temuan terbaru</li>
                                    <li>Menghubungi pos keamanan kampus untuk menanyakan lebih lanjut</li>
                                    <li>Melaporkan ke pihak berwajib jika diduga ada unsur pencurian</li>
                                </ol>
                                <p class="mb-0">Kami akan terus berupaya membantu Anda dengan memantau laporan yang masuk.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm mt-5">
                    <div class="card-body text-center p-4">
                        <h3 class="h4 mb-3">Masih ada pertanyaan?</h3>
                        <p class="mb-4">Jika Anda memiliki pertanyaan lain yang belum terjawab di atas, silakan lihat informasi kontak kami di bagian footer halaman ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.faq-header {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 2rem;
    margin-bottom: 3rem;
}

.accordion-button:not(.collapsed) {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.05);
}

.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,.125);
}

.accordion-button::after {
    background-size: 1rem;
    transition: transform 0.3s ease-in-out;
}

.accordion-button:not(.collapsed)::after {
    transform: rotate(180deg);
}

.card {
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
}

.btn-link {
    color: #212529;
    font-weight: 500;
    text-decoration: none;
}

.btn-link:hover {
    color: #0d6efd;
}
</style>

<script>
// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>

<?php include 'footer.php'; ?>
