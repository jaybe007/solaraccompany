<?php
/**
 * SOLARAC Company LTD - Main Navigation Menu
 */
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$navItems = [
    ['label' => 'Home', 'url' => url(''), 'file' => 'index.php'],
    ['label' => 'About Us', 'url' => url('about.php'), 'file' => 'about.php'],
    ['label' => 'Services', 'url' => url('services.php'), 'file' => 'services.php'],
    ['label' => 'Projects', 'url' => url('projects.php'), 'file' => 'projects.php'],
    ['label' => 'Certificates', 'url' => url('certificates.php'), 'file' => 'certificates.php'],
    ['label' => 'Meet The Team', 'url' => url('team.php'), 'file' => 'team.php'],
    ['label' => 'Insights', 'url' => url('blog.php'), 'file' => 'blog.php'],
    ['label' => 'Contact Us', 'url' => url('contact.php'), 'file' => 'contact.php'],
];
?>
<ul class="nav-menu" id="navMenu">
    <?php foreach ($navItems as $item): ?>
        <li>
            <a href="<?= e($item['url']) ?>" class="nav-link <?= ($currentPage === $item['file']) ? 'active' : '' ?>">
                <?= e($item['label']) ?>
            </a>
        </li>
    <?php endforeach; ?>
    <li class="mobile-only-cta" style="display: none;">
        <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-sm" style="width: 100%; margin-top: 10px;">
            REQUEST A QUOTE
        </a>
    </li>
</ul>
