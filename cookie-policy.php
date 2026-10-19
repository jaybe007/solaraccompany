<?php
/**
 * SOLARAC Company LTD - Cookie Policy
 */
require_once __DIR__ . '/config/config.php';

$page = Database::fetchOne("SELECT * FROM `pages` WHERE `slug` = 'cookie-policy' AND `status` = 'published' LIMIT 1");
$title = $page['title'] ?? 'Cookie Policy';
$content = $page['content'] ?? '<p>SOLARAC Company LTD uses essential session cookies solely to facilitate navigation, inquiry form security (CSRF protection), and enhance your browsing experience on our corporate civil engineering portal.</p>';

$pageTitle = ($page['meta_title'] ?? $title) . " | SOLARAC Company LTD";
$pageDescription = $page['meta_description'] ?? "Official cookie policy for SOLARAC Company LTD website.";

include INCLUDES_PATH . 'header.php';
?>

<div class="section-dark" style="padding: 50px 0; border-bottom: 3px solid var(--color-accent-500);">
    <div class="container" style="max-width: 860px;">
        <span class="section-tag section-tag-light">PRIVACY &amp; SECURITY</span>
        <h1 style="font-size: 2.5rem; color: #fff; margin-bottom: 8px;"><?= e($title) ?></h1>
        <p style="color: #cbd5e1; font-size: 0.95rem; margin-bottom: 0;">Last updated: <?= format_date($page['updated_at'] ?? 'now') ?></p>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 860px;">
        <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 40px; box-shadow: var(--shadow-sm); line-height: 1.8; color: var(--color-dark-800);">
            <?= $content ?>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
