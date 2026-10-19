<?php
/**
 * SOLARAC Company LTD - Homepage
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$pageTitle = "SOLARAC Company LTD | Civil Engineering, Building Construction & Project Management";
$pageDescription = "SOLARAC Company LTD (RC: 1175907) is a professional civil engineering, building construction, and facilities management firm specializing in structural design, high-capacity foundations, and major infrastructure in Nigeria.";

// Load dynamic data from DB
$services = Database::fetchAll("SELECT * FROM `services` WHERE `status` = 'active' ORDER BY `sort_order` ASC LIMIT 6");
$featuredProjects = Database::fetchAll("SELECT p.*, c.name as category_name FROM `projects` p JOIN `project_categories` c ON p.category_id = c.id WHERE p.published_status = 'published' ORDER BY p.id ASC LIMIT 6");
$testimonials = Database::fetchAll("SELECT * FROM `testimonials` WHERE `status` = 'published' ORDER BY `sort_order` ASC LIMIT 3");
$recentBlog = Database::fetchAll("SELECT b.*, c.name as category_name FROM `blog_posts` b JOIN `blog_categories` c ON b.category_id = c.id WHERE b.status = 'Published' ORDER BY b.published_at DESC LIMIT 3");

// Homepage section toggles from CMS
$heroEnabled       = Settings::getBool('section_hero_enabled', true);
$servicesEnabled   = Settings::getBool('section_services_enabled', true);
$whyChooseEnabled  = Settings::getBool('section_why_choose_enabled', true);
$projectsEnabled   = Settings::getBool('section_projects_enabled', true);
$quoteCtaEnabled   = Settings::getBool('section_quote_cta_enabled', true);
$testimonialsEnabled = Settings::getBool('section_testimonials_enabled', true);

include INCLUDES_PATH . 'header.php';
?>

<!-- 1. HERO SECTION WITH HIGH-IMPACT SLIDER -->
<?php if ($heroEnabled): ?>
<section class="hero-slider-container">
    <div class="hero-slider-bg">
        <div class="hero-slide active" style="background-image: url('<?= asset('images/slide1.jpg') ?>');"></div>
        <div class="hero-slide" style="background-image: url('<?= asset('images/projects/completed ataoja.jpeg') ?>');"></div>
        <div class="hero-slide" style="background-image: url('<?= asset('images/projects/fair faced reinforced concrete fence, free trade zone, osogbo.jpeg') ?>');"></div>
        <div class="hero-slide" style="background-image: url('<?= asset('images/projects/foundation work (1).jpeg') ?>');"></div>
        <div class="hero-slide" style="background-image: url('<?= asset('images/slide3.jpg') ?>');"></div>
        <div class="hero-slide-overlay"></div>
    </div>

    <div class="container" style="position: relative; z-index: 4;">
        <div class="hero-content">
            <div class="hero-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                <span>CIVIL &amp; BUILDING CONSTRUCTION &bull; RC: 1175907</span>
            </div>
            
            <h1 class="hero-title">
                Building the Future with <span>Integrity, Innovation &amp; Excellence.</span>
            </h1>
            
            <p class="hero-subtitle">
                <?= e(setting('hero_subheadline', 'SOLARAC Company LTD (RC: 1175907) is a premier Nigerian civil engineering and building construction firm delivering expertise in Project Management, Structural Design, General Facilities Management, and Turnkey EPC Contracting.')) ?>
            </p>
            
            <div class="hero-actions">
                <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg">
                    <span>REQUEST A QUOTE</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                <a href="<?= url('projects.php') ?>" class="btn btn-outline-gold btn-lg">
                    <span>EXPLORE PROJECTS</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <!-- Core Operational Pillars -->
            <div class="hero-pillars">
                <div class="pillar-item">
                    <div class="pillar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="9" y1="22" x2="9" y2="22.01"></line><line x1="15" y1="22" x2="15" y2="22.01"></line></svg>
                    </div>
                    <div class="pillar-text">Civil &amp; Building Construction</div>
                </div>
                <div class="pillar-item">
                    <div class="pillar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                    </div>
                    <div class="pillar-text">Turnkey Project Management</div>
                </div>
                <div class="pillar-item">
                    <div class="pillar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <div class="pillar-text">Heavy Raft Foundations</div>
                </div>
                <div class="pillar-item">
                    <div class="pillar-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <div class="pillar-text">Facilities &amp; Telecom Masts</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide Indicators -->
    <div class="hero-slider-dots">
        <div class="hero-slider-dot active" title="Slide 1"></div>
        <div class="hero-slider-dot" title="Slide 2"></div>
        <div class="hero-slider-dot" title="Slide 3"></div>
        <div class="hero-slider-dot" title="Slide 4"></div>
        <div class="hero-slider-dot" title="Slide 5"></div>
    </div>
</section>
<?php endif; ?>

<!-- 2. STATS & CREDENTIALS RIBBON -->
<section class="stats-ribbon">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div>
                    <div class="stat-num">20+</div>
                    <div class="stat-label">Years Leadership Experience</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div>
                    <div class="stat-num">RC: 1175907</div>
                    <div class="stat-label">CAC Registered Limited Liability</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <div>
                    <div class="stat-num">100+</div>
                    <div class="stat-label">Civil &amp; Structural Deliveries</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <div>
                    <div class="stat-num">BPP &bull; FIRS</div>
                    <div class="stat-label">PenCom &amp; ITF Federal Compliant</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. ABOUT SOLARAC COMPANY LTD PREVIEW -->
<section class="section" id="aboutPreview">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center;">
            <div>
                <span class="section-tag">ABOUT OUR FIRM</span>
                <h2 class="section-title" style="margin-bottom: 20px;">Dedicated to Precision in Engineering &amp; Project Delivery</h2>
                <p style="font-size: 1.05rem; line-height: 1.7; color: var(--color-dark-700);">
                    <strong>SOLARAC Company Limited (RC:1175907)</strong> is a Limited Liability Company incorporated to deliver exceptional expertise in Project Management, Civil Engineering and Construction, General Facilities Management, and Turnkey Contracting.
                </p>
                <p style="color: var(--color-dark-600); line-height: 1.65;">
                    Headquartered in Osogbo, Osun State, we are steered by COREN-registered engineers and project management professionals with diverse technical backgrounds across structural design, geotechnical foundation analysis, road construction, telecom mast installations, and large-scale public infrastructure.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin: 28px 0 32px;">
                    <div style="background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%); padding: 20px; border-radius: 12px; border: 1px solid #a7f3d0; border-left: 4px solid #059669; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.08);">
                        <strong style="color: var(--color-primary-900); display: block; margin-bottom: 6px; font-size: 0.95rem;">Our Mission</strong>
                        <p style="font-size: 0.86rem; margin-bottom: 0; color: var(--color-dark-600); line-height: 1.55;">To build the future with integrity, innovation, and excellence while fostering safety and sustainable community impact.</p>
                    </div>
                    <div style="background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%); padding: 20px; border-radius: 12px; border: 1px solid #fde68a; border-left: 4px solid #d97706; box-shadow: 0 4px 12px rgba(217, 119, 6, 0.08);">
                        <strong style="color: var(--color-primary-900); display: block; margin-bottom: 6px; font-size: 0.95rem;">Our Vision</strong>
                        <p style="font-size: 0.86rem; margin-bottom: 0; color: var(--color-dark-600); line-height: 1.55;">To be the trusted leader in construction and infrastructure delivery, creating lasting value for our clients and nation.</p>
                    </div>
                </div>
                <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
                    <a href="<?= url('about.php') ?>" class="btn btn-navy">Learn More About Us &rarr;</a>
                    <a href="<?= url('certificates.php') ?>" class="btn btn-outline" style="color: var(--color-primary-900); border-color: var(--color-gray-300);">View Certifications</a>
                </div>
            </div>

            <div style="position: relative;">
                <div style="position: relative; border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-xl);">
                    <img src="<?= asset('images/projects/completed ataoja.jpeg') ?>" alt="Ataoja Model School of Science Project" style="width: 100%; height: 440px; object-fit: cover; display: block;">
                    <div style="position: absolute; bottom: 0; inset-inline: 0; background: linear-gradient(transparent, rgba(4, 16, 12, 0.95)); padding: 30px; color: #fff;">
                        <span style="background: linear-gradient(135deg, #059669, #10b981); color: #fff; font-size: 0.72rem; font-weight: 700; padding: 4px 10px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px;">Landmark Project</span>
                        <h4 style="color: #fff; font-size: 1.25rem; margin: 8px 0 4px;">Ataoja Model School of Science, Osogbo</h4>
                        <p style="color: #cbd5d0; font-size: 0.86rem; margin-bottom: 0;">Supervised and constructed by SOLARAC Company LTD to the highest standards.</p>
                    </div>
                </div>
                <!-- Float Badge -->
                <div style="position: absolute; top: -20px; right: -20px; background: var(--color-white); border: 2px solid #10b981; border-radius: 14px; padding: 14px 22px; box-shadow: 0 12px 30px rgba(16, 185, 129, 0.22); text-align: center;">
                    <span style="font-family: var(--font-heading); font-size: 1.6rem; font-weight: 800; background: linear-gradient(135deg, #081d15, #059669); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: block; line-height: 1;">RC:1175907</span>
                    <span style="font-size: 0.72rem; font-weight: 700; color: #d97706; text-transform: uppercase; letter-spacing: 0.5px;">Certified Company</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. CORE ENGINEERING SERVICES -->
<?php if ($servicesEnabled && !empty($services)): ?>
<section class="section section-gray" id="servicesSection">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">OUR CORE EXPERTISE</span>
            <h2 class="section-title">Comprehensive Engineering &amp; Construction Solutions</h2>
            <p class="section-subtitle">
                From structural concept and foundation analysis to turnkey delivery and facilities maintenance across Nigeria.
            </p>
        </div>

        <div class="services-grid">
            <?php foreach ($services as $srv): ?>
            <div class="service-card">
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

                <h3><?= e($srv['title']) ?></h3>
                <p><?= e($srv['short_description']) ?></p>

                <?php 
                $feats = [];
                if (!empty($srv['features'])) {
                    $decoded = json_decode($srv['features'], true);
                    if (is_array($decoded)) {
                        $feats = array_slice($decoded, 0, 3);
                    }
                }
                ?>
                <?php if (!empty($feats)): ?>
                <ul class="service-features-list">
                    <?php foreach ($feats as $f): ?>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span><?= e($f) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <a href="<?= url('services.php#' . urlencode($srv['slug'])) ?>" class="service-link">
                    Explore Technical Specs &rarr;
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 45px;">
            <a href="<?= url('services.php') ?>" class="btn btn-navy btn-lg">
                View All Construction Services &rarr;
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 5. FEATURED LANDMARK PROJECTS GALLERY -->
<?php if ($projectsEnabled && !empty($featuredProjects)): ?>
<section class="section" id="featuredProjects">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">PROVEN TRACK RECORD</span>
            <h2 class="section-title">Landmark Construction Projects</h2>
            <p class="section-subtitle">
                Showcasing our dedication to engineering integrity, durability, and on-time execution across public and private sectors.
            </p>
        </div>

        <div class="projects-grid">
            <?php foreach ($featuredProjects as $proj): 
                $statusClass = match (strtolower($proj['status'])) {
                    'completed' => 'status-completed',
                    'ongoing' => 'status-ongoing',
                    default => 'status-upcoming'
                };
            ?>
            <div class="project-card">
                <div class="project-thumb">
                    <img src="<?= upload_url($proj['featured_image'], 'assets/images/placeholder.svg') ?>" alt="<?= e($proj['title']) ?>" loading="lazy">
                    <span class="status-badge <?= $statusClass ?>"><?= ucfirst(e($proj['status'])) ?></span>
                    <button type="button" class="cert-zoom-btn" data-lightbox-img="<?= upload_url($proj['featured_image']) ?>" data-lightbox-title="<?= e($proj['title']) ?>">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>View Photo</span>
                    </button>
                </div>
                <div class="project-body">
                    <div class="project-meta">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <?= e($proj['location']) ?>
                        </span>
                        <span>&bull;</span>
                        <span><?= e($proj['category_name']) ?></span>
                    </div>

                    <h3><?= e($proj['title']) ?></h3>
                    <p><?= truncate($proj['description'], 130) ?></p>

                    <div style="margin-top: auto; padding-top: 14px; border-top: 1px solid var(--color-gray-100);">
                        <a href="<?= url('projects.php?slug=' . urlencode($proj['slug'])) ?>" class="service-link">
                            View Full Project Scope &rarr;
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 45px;">
            <a href="<?= url('projects.php') ?>" class="btn btn-navy btn-lg">
                Explore Complete Project Portfolio &rarr;
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 6. CERTIFICATES & RECOGNITION SPOTLIGHT RIBBON -->
<section class="section section-dark" id="certificatesRibbon">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 40px; align-items: center;">
            <div>
                <span class="section-tag section-tag-light">GOVERNMENT ACCREDITED</span>
                <h2 class="section-title" style="color: #fff; font-size: 2.2rem; margin-bottom: 18px;">
                    Accredited, Tax-Compliant &amp; Award-Winning Credentials
                </h2>
                <p style="color: #cbd5e1; line-height: 1.7; margin-bottom: 24px;">
                    SOLARAC Company LTD operates with 100% transparency and regulatory compliance across all statutory federal bodies. We hold active certifications from the Bureau of Public Procurement (BPP IRR), Federal Inland Revenue Service (FIRS), PenCom, and the Industrial Training Fund (ITF).
                </p>
                <div style="display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 30px;">
                    <span class="cred-pill" style="font-size: 0.82rem; padding: 6px 12px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg> BPP Federal Contractor (IRR)</span>
                    <span class="cred-pill" style="font-size: 0.82rem; padding: 6px 12px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg> FIRS Tax Compliance</span>
                    <span class="cred-pill" style="font-size: 0.82rem; padding: 6px 12px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg> PenCom &amp; ITF Compliance</span>
                    <span class="cred-pill" style="font-size: 0.82rem; padding: 6px 12px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg> 2023 National Excellence Award</span>
                </div>
                <a href="<?= url('certificates.php') ?>" class="btn btn-primary btn-lg">
                    <span>Inspect Certificates &amp; Recognition &rarr;</span>
                </a>
            </div>

            <!-- Certificate Mini Showcase -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                <div style="background: rgba(255,255,255,0.06); padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.12); cursor: pointer;" data-lightbox-img="<?= asset('images/certificates/page24_img2.png') ?>" data-lightbox-title="Bureau of Public Procurement (BPP) Certificate">
                    <img src="<?= asset('images/certificates/page24_img2.png') ?>" alt="BPP Certificate" style="width: 100%; height: 130px; object-fit: contain; background: #fff; border-radius: 6px;">
                    <div style="margin-top: 10px; font-size: 0.78rem; font-weight: 700; color: #fff; text-align: center;">BPP Federal (IRR)</div>
                </div>
                <div style="background: rgba(255,255,255,0.06); padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.12); cursor: pointer;" data-lightbox-img="<?= asset('images/certificates/page25_img2.png') ?>" data-lightbox-title="Federal Inland Revenue Service (FIRS) Certificate">
                    <img src="<?= asset('images/certificates/page25_img2.png') ?>" alt="FIRS Certificate" style="width: 100%; height: 130px; object-fit: contain; background: #fff; border-radius: 6px;">
                    <div style="margin-top: 10px; font-size: 0.78rem; font-weight: 700; color: #fff; text-align: center;">FIRS Tax Compliant</div>
                </div>
                <div style="background: rgba(255,255,255,0.06); padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.12); cursor: pointer;" data-lightbox-img="<?= asset('images/certificates/unnamed (2).png') ?>" data-lightbox-title="National Excellence Award in Civil Engineering">
                    <img src="<?= asset('images/certificates/unnamed (2).png') ?>" alt="Excellence Award" style="width: 100%; height: 130px; object-fit: contain; background: #fff; border-radius: 6px;">
                    <div style="margin-top: 10px; font-size: 0.78rem; font-weight: 700; color: #fff; text-align: center;">National Award (2023)</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. WHY CHOOSE SOLARAC COMPANY LTD -->
<?php if ($whyChooseEnabled): ?>
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">ENGINEERING ADVANTAGE</span>
            <h2 class="section-title">Why Construction Clients Trust SOLARAC</h2>
            <p class="section-subtitle">
                Our approach delivers structural reliability, strict budget discipline, and zero-compromise safety on every project.
            </p>
        </div>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-number">01</div>
                <h3>Registered &amp; Certified Engineers</h3>
                <p>Our team comprises COREN-registered engineers, MNSE members, and PMP-certified managers with nearly two decades of field experience.</p>
            </div>
            <div class="why-card">
                <div class="why-number">02</div>
                <h3>Advanced QA/QC &amp; Structural Codes</h3>
                <p>We build strictly in compliance with Eurocode, BS, and Nigerian building codes, conducting routine cube crushing tests and geotechnical reviews.</p>
            </div>
            <div class="why-card">
                <div class="why-number">03</div>
                <h3>Substructure &amp; Raft Foundation Mastery</h3>
                <p>Proven track record executing high-capacity raft foundations in complex and waterlogged terrains, including 40 units at Lekki Scheme 2, Lagos.</p>
            </div>
            <div class="why-card">
                <div class="why-number">04</div>
                <h3>On-Time CPM Scheduling</h3>
                <p>We deploy Critical Path Method (CPM) tracking and weekly milestone reviews to guarantee project delivery without unnecessary contractor delays.</p>
            </div>
            <div class="why-card">
                <div class="why-number">05</div>
                <h3>Rigorous HSE &amp; Site Safety</h3>
                <p>Advanced Health, Safety &amp; Environment (HSE) protocols ensure zero incidents, protective equipment adherence, and environmental protection.</p>
            </div>
            <div class="why-card">
                <div class="why-number">06</div>
                <h3>Transparent BOQ &amp; Cost Control</h3>
                <p>Detailed bill of quantities (BOQ) with milestone-based payment schedules to ensure maximum cost transparency and client value.</p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 8. CLIENT TESTIMONIALS -->
<?php if ($testimonialsEnabled && !empty($testimonials)): ?>
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">CLIENT TESTIMONIALS</span>
            <h2 class="section-title">What Our Project Partners Say</h2>
            <p class="section-subtitle">
                Feedback from school governing boards, industrial authorities, and institutional foundation trustees.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php foreach ($testimonials as $t): ?>
            <div style="background: var(--color-white); border-radius: var(--radius-lg); padding: 32px; border: 1px solid var(--color-gray-200); display: flex; flex-direction: column; box-shadow: var(--shadow-sm);">
                <div style="display: flex; gap: 4px; color: #f59e0b; margin-bottom: 16px;">
                    <?php for ($i = 0; $i < (int)$t['rating']; $i++): ?>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <?php endfor; ?>
                </div>
                <p style="font-size: 0.95rem; line-height: 1.65; color: var(--color-dark-700); font-style: italic; margin-bottom: 24px;">
                    &ldquo;<?= e($t['content']) ?>&rdquo;
                </p>
                <div style="margin-top: auto; padding-top: 16px; border-top: 1px solid var(--color-gray-100);">
                    <strong style="color: var(--color-primary-900); display: block; font-size: 1rem;"><?= e($t['client_name']) ?></strong>
                    <span style="font-size: 0.8rem; color: var(--color-dark-600);"><?= e($t['organization']) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 9. HIGH-IMPACT CONSULTATION / RFQ CTA BANNER -->
<?php if ($quoteCtaEnabled): ?>
<section class="section" style="padding-top: 20px;">
    <div class="container">
        <div class="rfq-feature-banner">
            <div>
                <span class="section-tag section-tag-light">GET A CONSTRUCTION QUOTE</span>
                <h2 style="color: #fff; font-size: 2.15rem; margin: 8px 0 12px 0;">Ready to Start Your Next Construction Project?</h2>
                <p style="color: #cbd5e1; max-width: 620px; margin-bottom: 0; font-size: 1.02rem;">
                    Submit your architectural drawings, Bill of Quantities (BOQ), or project specifications. Our engineering team provides detailed feasibility analysis, cost estimates, and construction timelines.
                </p>
            </div>
            <div style="flex-shrink: 0; display: flex; gap: 14px; flex-wrap: wrap;">
                <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg" style="font-size: 1.05rem;">
                    <span>SUBMIT PROJECT RFQ</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                <a href="tel:08035188495" class="btn btn-outline-gold btn-lg" style="font-size: 1.05rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <span>CALL: 08035188495</span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 10. RECENT TECHNICAL INSIGHTS -->
<?php if (!empty($recentBlog)): ?>
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">ENGINEERING INSIGHTS</span>
            <h2 class="section-title">Latest Construction Publications &amp; Case Studies</h2>
            <p class="section-subtitle">
                Practical engineering breakdowns, project reviews, and best practices in Nigerian civil infrastructure.
            </p>
        </div>

        <div class="blog-grid">
            <?php foreach ($recentBlog as $post): ?>
            <div class="blog-card">
                <div class="blog-thumb">
                    <img src="<?= upload_url($post['featured_image'], 'assets/images/placeholder.svg') ?>" alt="<?= e($post['title']) ?>" loading="lazy">
                </div>
                <div class="blog-body">
                    <div class="blog-meta">
                        <span><?= format_date($post['published_at']) ?></span>
                        <span>&bull;</span>
                        <span><?= e($post['category_name']) ?></span>
                    </div>
                    <h3><?= e($post['title']) ?></h3>
                    <p><?= truncate($post['excerpt'], 120) ?></p>
                    <a href="<?= url('blog.php?slug=' . urlencode($post['slug'])) ?>" class="service-link">
                        Read Case Study &rarr;
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include INCLUDES_PATH . 'footer.php'; ?>
