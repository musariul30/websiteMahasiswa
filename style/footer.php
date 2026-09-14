<?php
$isSubDir = preg_match('#/(?:home|admin)/#', $_SERVER['SCRIPT_NAME'] ?? '');
$footerBase = $isSubDir ? '../' : '';
?>
<link rel="stylesheet" href="<?= $footerBase ?>style/footer.css">

<footer class="footer-modern text-white">
    <!-- Social -->
    <section class="footer-top">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <span class="social-label">
                    <i class="fas fa-share-alt me-2"></i>Ikuti kami di media sosial
                </span>
                <div class="social-links d-flex">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Google"><i class="fab fa-google"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Links & Contact -->
    <section class="footer-main">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-title">UNS</h6>
                    <p class="mb-0">
                        Sistem informasi data mahasiswa. Kelola data mahasiswa dengan mudah dan terintegrasi.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-title">Tautan</h6>
                    <p><a href="#">Berita</a></p>
                    <p><a href="#">Informasi</a></p>
                    <p><a href="#">Bantuan</a></p>
                </div>
                <div class="col-lg-4 col-md-6 ms-lg-auto">
                    <h6 class="footer-title">Kontak</h6>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> Surakarta</p>
                        <p><i class="fas fa-envelope"></i> UNS@student.ac.id</p>
                        <p><i class="fas fa-phone"></i> +62 234 567 88</p>
                        <p><i class="fas fa-fax"></i> +62 234 567 89</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="footer-bottom text-center">
        <div class="container">
            © <?= date('Y') ?> <a href="#">Universitas Sebelas Maret</a>. All rights reserved.
        </div>
    </div>
</footer>
