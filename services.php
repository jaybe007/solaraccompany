<?php
/**
 * SOLARAC Company LTD - Engineering Services Directory & Single Service View
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$slug = trim($_GET['slug'] ?? '');

if (!empty($slug)) {
    // Single Service Detail
    $service = Database::fetchOne(
        "SELECT s.*, c.name as category_name 
         FROM `services` s 
         JOIN `service_categories` c ON s.category_id = c.id 
         WHERE s.slug = :s AND s.status = 'active' LIMIT 1",
        [':s' => $slug]
    );

    if (!$service) {
        http_response_code(404);
        include ROOT_PATH . '404.php';
        exit;
    }

    $pageTitle = ($service['meta_title'] ?? '') ?: ($service['title'] . " | SOLARAC Company LTD");
    $pageDescription = ($service['meta_description'] ?? '') ?: $service['short_description'];
    
    // Other services for sidebar
    $otherServices = Database::fetchAll("SELECT title, slug FROM `services` WHERE `status` = 'active' AND `id` != :id ORDER BY `sort_order` ASC", [':id' => $service['id']]);

    include INCLUDES_PATH . 'header.php';
    ?>
    <div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #071221 0%, #0c203b 100%);">
        <div class="container">
            <span class="section-tag section-tag-light"><?= e($service['category_name']) ?></span>
            <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;"><?= e($service['title']) ?></h1>
            <p style="color: #cbd5e1; max-width: 780px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
                <?= e($service['short_description']) ?>
            </p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 48px; align-items: start;">
                <!-- Main Service Content -->
                <div>
                    <?php if (!empty($service['image'])): ?>
                    <div style="border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 35px; box-shadow: var(--shadow-md); max-height: 400px;">
                        <img src="<?= upload_url($service['image']) ?>" alt="<?= e($service['title']) ?>" style="width: 100%; height: 380px; object-fit: cover;">
                    </div>
                    <?php endif; ?>

                    <div style="font-size: 1.05rem; line-height: 1.8; color: var(--color-dark-700); margin-bottom: 36px;">
                        <?= $service['full_description'] ?>
                    </div>

                    <?php 
                    $features = [];
                    if (!empty($service['features'])) {
                        $dec = json_decode($service['features'], true);
                        $features = is_array($dec) ? $dec : explode('||', $service['features']);
                    }
                    ?>
                    <?php if (!empty($features)): ?>
                    <div style="background: var(--color-gray-100); border-radius: var(--radius-md); padding: 32px; margin-bottom: 40px; border-left: 4px solid var(--color-accent-500);">
                        <h3 style="font-size: 1.3rem; margin-bottom: 18px; color: var(--color-primary-900);">Core Capabilities &amp; Key Deliverables</h3>
                        <div style="display: grid; grid-template-columns: 1fr; gap: 14px;">
                            <?php foreach ($features as $f): ?>
                            <div style="display: flex; align-items: flex-start; gap: 12px; font-size: 0.96rem; color: var(--color-dark-800);">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="color: var(--color-accent-500); flex-shrink: 0; margin-top: 2px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span><?= e(trim($f)) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Action Box -->
                    <div class="rfq-feature-banner" style="margin-top: 30px;">
                        <div>
                            <h3 style="color: #fff; font-size: 1.55rem; margin-bottom: 8px;">Request an Engineering Quote</h3>
                            <p style="color: #cbd5e1; margin-bottom: 0; font-size: 0.95rem;">
                                Submit your site details or drawings for <strong><?= e($service['title']) ?></strong>.
                            </p>
                        </div>
                        <a href="<?= url('quote.php?service=' . urlencode($service['title'])) ?>" class="btn btn-primary btn-lg">
                            REQUEST A QUOTE
                        </a>
                    </div>
                </div>

                <!-- Sidebar Directory -->
                <div>
                    <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 26px; margin-bottom: 30px; box-shadow: var(--shadow-sm);">
                        <h4 style="font-size: 1.15rem; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 1px solid var(--color-gray-200); color: var(--color-primary-900);">All Construction Services</h4>
                        <ul style="display: flex; flex-direction: column; gap: 10px; list-style: none;">
                            <?php foreach ($otherServices as $os): ?>
                            <li>
                                <a href="<?= url('services.php?slug=' . urlencode($os['slug'])) ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; border-radius: var(--radius-sm); background: var(--color-gray-100); color: var(--color-dark-800); font-size: 0.9rem; font-weight: 600;">
                                    <span><?= e($os['title']) ?></span>
                                    <span style="color: var(--color-accent-500);">&rarr;</span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Direct Contact Assistance Box -->
                    <div style="background: var(--color-primary-900); color: #fff; border-radius: var(--radius-md); padding: 28px;">
                        <h4 style="color: #fff; font-size: 1.15rem; margin-bottom: 10px;">Speak With An Engineer</h4>
                        <p style="color: #cbd5e1; font-size: 0.88rem; margin-bottom: 20px; line-height: 1.55;">
                            Need technical consultation or site inspection for your upcoming project?
                        </p>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <a href="tel:<?= e(setting('phone_primary', '08035188495')) ?>" class="btn btn-outline-gold btn-sm" style="width: 100%;">
                                Call: <?= e(setting('phone_primary', '08035188495')) ?>
                            </a>
                            <a href="<?= url('contact.php') ?>" class="btn btn-outline-light btn-sm" style="width: 100%;">
                                Contact Headquarters
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include INCLUDES_PATH . 'footer.php';
    exit;
}

// Full Services Listing
$pageTitle = "Civil Engineering & Construction Services | SOLARAC Company LTD";
$pageDescription = "Explore SOLARAC Company LTD's core construction capabilities: Project Management, Civil Engineering, Raft Foundation Design, Reinforced Concrete Fencing, Road Transport, and Facilities Management.";

$services = Database::fetchAll("SELECT s.*, c.name as category_name FROM `services` s JOIN `service_categories` c ON s.category_id = c.id WHERE s.status = 'active' ORDER BY s.sort_order ASC");

include INCLUDES_PATH . 'header.php';
?>

<div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #071221 0%, #0c203b 100%);">
    <div class="container">
        <span class="section-tag section-tag-light">TECHNICAL CAPABILITIES</span>
        <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;">Civil Engineering &amp; Construction Services</h1>
        <p style="color: #cbd5e1; max-width: 760px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
            Comprehensive construction engineering solutions encompassing the full project lifecycle &mdash; from geotechnical analysis, architectural planning, and structural design to site execution, quality control, and handover.
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="services-grid">
            <?php foreach ($services as $srv): ?>
            <div class="service-card" id="<?= e($srv['slug']) ?>">
                <div class="service-icon-box">
                    <?php if ($srv['icon'] === 'briefcase'): ?>
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <?php elseif ($srv['icon'] === 'building'): ?>
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="9" y1="22" x2="9" y2="22.01"></line><line x1="15" y1="22" x2="15" y2="22.01"></line><line x1="8" y1="6" x2="10" y2="6"></line><line x1="14" y1="6" x2="16" y2="6"></line><line x1="8" y1="10" x2="10" y2="10"></line><line x1="14" y1="10" x2="16" y2="10"></line></svg>
                    <?php elseif ($srv['icon'] === 'layers'): ?>
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    <?php elseif ($srv['icon'] === 'shield'): ?>
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <?php elseif ($srv['icon'] === 'truck'): ?>
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    <?php else: ?>
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                    <?php endif; ?>
                </div>
                <div style="font-size: 0.76rem; font-weight: 700; color: var(--color-accent-600); text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.05em;">
                    <?= e($srv['category_name']) ?>
                </div>
                <h3><?= e($srv['title']) ?></h3>
                <p><?= e($srv['short_description']) ?></p>

                <?php 
                $feats = [];
                if (!empty($srv['features'])) {
                    $dec = json_decode($srv['features'], true);
                    $feats = is_array($dec) ? array_slice($dec, 0, 4) : array_slice(explode('||', $srv['features']), 0, 4);
                }
                ?>
                <?php if (!empty($feats)): ?>
                <ul class="service-features-list">
                    <?php foreach ($feats as $f): ?>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span><?= e(trim($f)) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 14px; border-top: 1px solid var(--color-gray-100);">
                    <a href="<?= url('services.php?slug=' . urlencode($srv['slug'])) ?>" class="service-link">
                        Technical Scope &rarr;
                    </a>
                    <a href="<?= url('quote.php?service=' . urlencode($srv['title'])) ?>" class="btn btn-outline-gold btn-sm">
                        Quote &rarr;
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Direct RFQ Call to Action -->
<section class="section section-gray">
    <div class="container" style="text-align: center; max-width: 780px;">
        <span class="section-tag">START YOUR PROJECT</span>
        <h2 class="section-title">Need Professional Engineering Consultation?</h2>
        <p class="section-subtitle" style="margin-bottom: 30px;">
            Contact our structural engineers and project managers to evaluate your bill of quantities or schedule an on-site survey.
        </p>
        <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
            <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg">REQUEST DETAILED ESTIMATE</a>
            <a href="<?= url('contact.php') ?>" class="btn btn-navy btn-lg">CONTACT HEADQUARTERS</a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
