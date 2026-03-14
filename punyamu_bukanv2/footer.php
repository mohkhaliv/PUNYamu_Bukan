</main>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5><i class="fas fa-search-location me-2"></i>PUNYamu Bukan?</h5>
                    <p class="mt-3">Platform untuk melaporkan dan menemukan barang hilang di lingkungan Universitas Negeri Yogyakarta. Mari bersama-sama membantu menemukan barang yang hilang!</p>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5>Menu</h5>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-chevron-right me-2"></i>Beranda</a></li>
                        <li><a href="lapor.php"><i class="fas fa-chevron-right me-2"></i>Laporkan Barang</a></li>
                        <li><a href="barang_ditemukan.php"><i class="fas fa-chevron-right me-2"></i>Barang Ditemukan</a></li>
                        <li><a href="barang_hilang.php"><i class="fas fa-chevron-right me-2"></i>Barang Hilang</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5>Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="syarat_ketentuan.php"><i class="fas fa-chevron-right me-2"></i>Syarat & Ketentuan</a></li>
                        <li><a href="kebijakan_privasi.php"><i class="fas fa-chevron-right me-2"></i>Kebijakan Privasi</a></li>
                        <li><a href="faq.php"><i class="fas fa-chevron-right me-2"></i>FAQ</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5>Informasi & Kontak</h5>
                    <ul class="footer-links">
                        <li class="mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <a href="tentang.php">Tentang Kami</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>Jl. Colombo No.1, Karang Malang, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:punyamubukan@uny.ac.id">punyamubukan@uny.ac.id</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone-alt me-2"></i>
                            <a href="tel:+62274586168">(0274) 586168</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright text-center mt-5">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> PUNYamu Bukan? - All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Template Javascript -->
    <script>
        // Active nav link
        $(document).ready(function() {
            var url = window.location;
            $('ul.navbar-nav a[href="'+url+'"]').addClass('active');
            $('ul.navbar-nav a').filter(function() {
                return this.href == url;
            }).addClass('active');
        });
    </script>
</body>
</html>