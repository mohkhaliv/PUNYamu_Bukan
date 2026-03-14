                <footer class="mt-5 pt-3 text-muted text-center">
                    <div class="container">
                        <p class="mb-1">&copy; <?= date('Y') ?> PUNYamu Bukan? - All Rights Reserved</p>
                        <p class="mb-0">Sistem Informasi Barang Temuan UNY</p>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Enable tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>
