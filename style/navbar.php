<?php
$isSubDir = preg_match('#/(?:home|admin)/#', $_SERVER['SCRIPT_NAME'] ?? '');
$navBase = $isSubDir ? '../' : '';
$navIndex = $isSubDir ? '../index.php' : 'index.php';
$navAdmin = $isSubDir ? '../admin/index.php' : 'admin/index.php';
$navAssets = $navBase . 'assets';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $navBase ?>style/navbar.css">

<nav class="navbar navbar-expand-lg navbar-dark navbar-modern">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $navIndex ?>">
            <i class="fas fa-graduation-cap"></i>
            <span>Data Mahasiswa</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= strpos($_SERVER['SCRIPT_NAME'] ?? '', '/admin/') === false ? 'active' : '' ?>" href="<?= $navIndex ?>">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($_SERVER['SCRIPT_NAME'] ?? '', '/admin/') !== false ? 'active' : '' ?>" href="<?= $navAdmin ?>">
                        <i class="fas fa-cog me-1"></i>Admin
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav d-flex flex-row align-items-center ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $navAssets ?>/profile.jpg" class="rounded-circle" width="28" height="28" alt="Profile" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                        <i class="fas fa-user-circle fa-lg d-none" style="color: rgba(255,255,255,0.9);"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="<?= $navAdmin ?>"><i class="fas fa-cog"></i> Admin</a></li>
                        <li><a class="dropdown-item" href="<?= $navIndex ?>"><i class="fas fa-home"></i> Home</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profil</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
