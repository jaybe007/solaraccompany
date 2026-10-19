<?php
/**
 * SOLARAC Company LTD - Project Portfolio & Single Project Case View
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$slug = trim($_GET['slug'] ?? '');
$categoryFilter = trim($_GET['category'] ?? '');
$statusFilter = trim($_GET['status'] ?? '');

if (!empty($slug)) {
    // Single Project View
    $project = Database::fetchOne(
        "SELECT p.*, c.name as category_name, c.slug as category_slug 
         FROM `projects` p 
         JOIN `project_categories` c ON p.category_id = c.id 
         WHERE p.slug = :s AND p.published_status = 'published' LIMIT 1",
        [':s' => $slug]
    );

    if (!$project) {
        http_response_code(404);
        include ROOT_PATH . '404.php';
        exit;
    }

    $pageTitle = $project['title'] . " | Project Case Study | SOLARAC Company LTD";
    $pageDescription = truncate($project['description'], 160);
    $gallery = Database::fetchAll("SELECT * FROM `project_images` WHERE `project_id` = :pid ORDER BY `sort_order` ASC", [':pid' => $project['id']]);

    include INCLUDES_PATH . 'header.php';
    ?>
    <div class="section-dark" style="padding: 60px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #071221 0%, #0c203b 100%);">
        <div class="container">
            <div class="breadcrumbs" style="margin-bottom: 12px; color: #94a3b8; font-size: 0.88rem;">
                <a href="<?= url('') ?>" style="color: #cbd5e1;">Home</a> &rarr; 
                <a href="<?= url('projects.php') ?>" style="color: #cbd5e1;">Projects</a> &rarr; 
                <span style="color: var(--color-accent-400);"><?= e($project['title']) ?></span>
            </div>
            <h1 style="font-size: 2.6rem; color: #fff; margin-bottom: 10px;"><?= e($project['title']) ?></h1>
            <div style="display: flex; gap: 16px; align-items: center; font-size: 0.92rem; color: #cbd5e1; flex-wrap: wrap;">
                <span>Category: <strong><?= e($project['category_name']) ?></strong></span>
                <span>&bull;</span>
                <span>Location: <strong><?= e($project['location']) ?></strong></span>
                <span>&bull;</span>
                <span>Client: <strong><?= e($project['client']) ?></strong></span>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 48px; align-items: start;">
                <!-- Main Project Scope & Description -->
                <div>
                    <div style="position: relative; margin-bottom: 24px; border-radius: var(--radius-md); overflow: hidden; max-height: 480px; background: #000; box-shadow: var(--shadow-lg);">
                        <img id="mainProjectImg" src="<?= upload_url($project['featured_image'], 'assets/images/placeholder.svg') ?>" alt="<?= e($project['title']) ?>" style="width: 100%; height: 440px; object-fit: cover; display: block;">
                        <button type="button" class="cert-zoom-btn" onclick="document.querySelector('[data-lightbox-main]').click()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                            <span>Enlarge Image</span>
                        </button>
                        <span data-lightbox-main data-lightbox-img="<?= upload_url($project['featured_image']) ?>" data-lightbox-title="<?= e($project['title']) ?>" style="display:none;"></span>
                    </div>

                    <?php if (!empty($gallery)): ?>
                    <div style="display: flex; gap: 12px; overflow-x: auto; padding-bottom: 10px; margin-bottom: 30px;">
                        <div style="width: 90px; height: 65px; border: 2px solid var(--color-accent-500); border-radius: var(--radius-sm); overflow: hidden; cursor: pointer; flex-shrink: 0;" onclick="document.getElementById('mainProjectImg').src='<?= upload_url($project['featured_image']) ?>'">
                            <img src="<?= upload_url($project['featured_image']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <?php foreach ($gallery as $g): ?>
                        <div style="width: 90px; height: 65px; border: 1px solid var(--color-gray-300); border-radius: var(--radius-sm); overflow: hidden; cursor: pointer; flex-shrink: 0;" onclick="document.getElementById('mainProjectImg').src='<?= upload_url($g['image_path']) ?>'">
                            <img src="<?= upload_url($g['image_path']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <h2 style="font-size: 1.65rem; margin-bottom: 16px; color: var(--color-primary-900);">Project Overview &amp; Execution</h2>
                    <div style="font-size: 1.05rem; line-height: 1.8; color: var(--color-dark-700); margin-bottom: 32px;">
                        <?= nl2br(e($project['description'])) ?>
                    </div>

                    <?php if (!empty($project['scope'])): ?>
                    <div style="background: var(--color-gray-100); border-radius: var(--radius-md); padding: 30px; margin-bottom: 36px; border-left: 4px solid var(--color-accent-500);">
                        <h3 style="font-size: 1.25rem; margin-bottom: 14px; color: var(--color-primary-900);">Engineering Scope of Work</h3>
                        <p style="font-size: 0.95rem; line-height: 1.7; color: var(--color-dark-800); margin-bottom: 0;">
                            <?= nl2br(e($project['scope'])) ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <div class="rfq-feature-banner">
                        <div>
                            <h3 style="color: #fff; font-size: 1.45rem; margin-bottom: 6px;">Planning a Similar Construction Project?</h3>
                            <p style="color: #cbd5e1; margin-bottom: 0; font-size: 0.92rem;">
                                Consult with our civil engineering and structural design leads today.
                            </p>
                        </div>
                        <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg">
                            REQUEST A QUOTE
                        </a>
                    </div>
                </div>

                <!-- Meta Sidebar -->
                <div>
                    <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 30px; box-shadow: var(--shadow-sm); margin-bottom: 24px;">
                        <h4 style="font-size: 1.2rem; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid var(--color-gray-200); color: var(--color-primary-900);">Project Factsheet</h4>
                        <table style="width: 100%; font-size: 0.92rem; border-collapse: collapse;">
                            <tbody>
                                <tr style="border-bottom: 1px solid var(--color-gray-100);">
                                    <td style="padding: 12px 0; color: var(--color-dark-600); font-weight: 600;">Execution Status</td>
                                    <td style="padding: 12px 0;">
                                        <?php
                                        $sClass = match (strtolower($project['status'])) {
                                            'completed' => 'status-completed',
                                            'ongoing' => 'status-ongoing',
                                            default => 'status-upcoming'
                                        };
                                        ?>
                                        <span class="status-badge <?= $sClass ?>" style="position: static;"><?= ucfirst(e($project['status'])) ?></span>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--color-gray-100);">
                                    <td style="padding: 12px 0; color: var(--color-dark-600); font-weight: 600;">Location</td>
                                    <td style="padding: 12px 0; color: var(--color-dark-800); font-weight: 600;"><?= e($project['location']) ?></td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--color-gray-100);">
                                    <td style="padding: 12px 0; color: var(--color-dark-600); font-weight: 600;">Client Entity</td>
                                    <td style="padding: 12px 0; color: var(--color-dark-800);"><?= e($project['client']) ?></td>
                                </tr>
                                <tr style="border-bottom: 1px solid var(--color-gray-100);">
                                    <td style="padding: 12px 0; color: var(--color-dark-600); font-weight: 600;">Sector</td>
                                    <td style="padding: 12px 0; color: var(--color-dark-800);"><?= e($project['category_name']) ?></td>
                                </tr>
                                <?php if ($project['completion_date']): ?>
                                <tr>
                                    <td style="padding: 12px 0; color: var(--color-dark-600); font-weight: 600;">Handover Date</td>
                                    <td style="padding: 12px 0; color: var(--color-dark-800);"><?= format_date($project['completion_date']) ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Direct Hotline Card -->
                    <div style="background: var(--color-primary-900); color: #fff; border-radius: var(--radius-md); padding: 28px;">
                        <h4 style="color: #fff; font-size: 1.15rem; margin-bottom: 10px;">Contact Project Team</h4>
                        <p style="color: #cbd5e1; font-size: 0.88rem; margin-bottom: 18px; line-height: 1.55;">
                            Speak directly with our civil engineering supervisors about this project or your upcoming site.
                        </p>
                        <a href="tel:08035188495" class="btn btn-outline-gold btn-sm" style="width: 100%; margin-bottom: 10px;">
                            Call: 08035188495
                        </a>
                        <a href="<?= url('quote.php') ?>" class="btn btn-outline-light btn-sm" style="width: 100%;">
                            Request Construction Quote
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include INCLUDES_PATH . 'footer.php';
    exit;
}

// Portfolio Listing Page
$pageTitle = "Civil & Building Construction Projects | SOLARAC Company LTD";
$pageDescription = "Explore SOLARAC Company LTD's landmark completed and ongoing construction projects across Nigeria, including Ataoja Model School of Science, Free Trade Zone concrete fencing, and raft foundations.";

$categories = Database::fetchAll("SELECT * FROM `project_categories` ORDER BY `id` ASC");

$sql = "SELECT p.*, c.name as category_name, c.slug as category_slug 
        FROM `projects` p 
        JOIN `project_categories` c ON p.category_id = c.id 
        WHERE p.published_status = 'published' ";
$params = [];

if (!empty($categoryFilter)) {
    $sql .= "AND c.slug = :cslug ";
    $params[':cslug'] = $categoryFilter;
}

if (!empty($statusFilter)) {
    $sql .= "AND LOWER(p.status) = :status ";
    $params[':status'] = strtolower($statusFilter);
}

$sql .= "ORDER BY p.id ASC";
$projects = Database::fetchAll($sql, $params);

include INCLUDES_PATH . 'header.php';
?>

<div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #071221 0%, #0c203b 100%);">
    <div class="container">
        <span class="section-tag section-tag-light">OUR TRACK RECORD</span>
        <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;">Project Portfolio</h1>
        <p style="color: #cbd5e1; max-width: 760px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
            A showcase of our commitment to excellence in civil engineering, educational infrastructure, industrial fencing, and high-capacity raft foundations across Nigeria.
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <!-- Filter Tabs -->
        <div class="filter-nav">
            <a href="<?= url('projects.php') ?>" class="filter-btn <?= (empty($categoryFilter) && empty($statusFilter)) ? 'active' : '' ?>">
                All Landmark Projects
            </a>
            <?php foreach ($categories as $cat): ?>
            <a href="<?= url('projects.php?category=' . urlencode($cat['slug'])) ?>" class="filter-btn <?= ($categoryFilter === $cat['slug']) ? 'active' : '' ?>">
                <?= e($cat['name']) ?>
            </a>
            <?php endforeach; ?>
            <a href="<?= url('projects.php?status=completed') ?>" class="filter-btn <?= ($statusFilter === 'completed') ? 'active' : '' ?>">
                Completed Executions
            </a>
            <a href="<?= url('projects.php?status=ongoing') ?>" class="filter-btn <?= ($statusFilter === 'ongoing') ? 'active' : '' ?>">
                Active Ongoing Works
            </a>
        </div>

        <?php if (empty($projects)): ?>
        <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 60px 20px; text-align: center;">
            <h3 style="font-size: 1.3rem; margin-bottom: 8px;">No Projects Found</h3>
            <p style="color: var(--color-dark-600); margin-bottom: 20px;">No projects currently registered under this filter.</p>
            <a href="<?= url('projects.php') ?>" class="btn btn-outline-gold btn-sm">View All Projects</a>
        </div>
        <?php else: ?>
        <div class="projects-grid">
            <?php foreach ($projects as $proj): 
                $sClass = match (strtolower($proj['status'])) {
                    'completed' => 'status-completed',
                    'ongoing' => 'status-ongoing',
                    default => 'status-upcoming'
                };
            ?>
            <div class="project-card">
                <div class="project-thumb">
                    <img src="<?= upload_url($proj['featured_image'], 'assets/images/placeholder.svg') ?>" alt="<?= e($proj['title']) ?>" loading="lazy">
                    <span class="status-badge <?= $sClass ?>"><?= ucfirst(e($proj['status'])) ?></span>
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

                    <div style="margin-top: auto; padding-top: 14px; border-top: 1px solid var(--color-gray-100); display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?= url('projects.php?slug=' . urlencode($proj['slug'])) ?>" class="service-link">
                            Case Details &rarr;
                        </a>
                        <span style="font-size: 0.76rem; color: var(--color-gray-400); max-width: 150px; text-align: right; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <?= e($proj['client']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Visual Portfolio Gallery Ribbon (All Site Construction Photos) -->
        <div style="margin-top: 70px; padding-top: 50px; border-top: 1px solid var(--color-gray-200);">
            <div class="section-header" style="margin-bottom: 30px;">
                <span class="section-tag">SITE IMAGERY</span>
                <h2 class="section-title">Field Operations &amp; Construction Gallery</h2>
                <p class="section-subtitle">
                    Snapshots from ongoing rebar placements, raft foundations, and structural site operations.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;">
                <?php
                $siteImages = [
                    ['src' => 'assets/images/projects/ata2.jpeg', 'title' => 'Ataoja Model School Superstructure Work'],
                    ['src' => 'assets/images/projects/reinforeced concrete fece obada-ede.jpeg', 'title' => 'Reinforced Concrete Fence Obada-Ede'],
                    ['src' => 'assets/images/projects/jk (1).jpeg', 'title' => 'Jokodolu Foundation Vocational Training Hall'],
                    ['src' => 'assets/images/projects/jk (2).jpeg', 'title' => 'Jokodolu Foundation Service Quarters'],
                    ['src' => 'assets/images/projects/foundation work (1).jpeg', 'title' => '40 Units Raft Foundation at Lekki Scheme 2'],
                    ['src' => 'assets/images/projects/foundation work (2).jpeg', 'title' => 'Foundation Beams & Earth Retention'],
                    ['src' => 'assets/images/projects/image-4.jpg', 'title' => 'Multi-Unit Residential Block Framing'],
                    ['src' => 'assets/images/projects/image-5.jpg', 'title' => 'Structural Framing & Reinforced Lintels'],
                ];
                foreach ($siteImages as $simg):
                ?>
                <div style="position: relative; height: 180px; border-radius: var(--radius-md); overflow: hidden; cursor: pointer; box-shadow: var(--shadow-sm);" data-lightbox-img="<?= asset($simg['src']) ?>" data-lightbox-title="<?= e($simg['title']) ?>">
                    <img src="<?= asset($simg['src']) ?>" alt="<?= e($simg['title']) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(transparent 60%, rgba(10,25,47,0.85)); display: flex; align-items: flex-end; padding: 12px; color: #fff; font-size: 0.78rem; font-weight: 600;">
                        <span><?= e($simg['title']) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Direct RFQ Call to Action -->
<section class="section section-gray">
    <div class="container" style="text-align: center; max-width: 780px;">
        <span class="section-tag">COMMENCE YOUR BUILD</span>
        <h2 class="section-title">Have a Tender or Site Ready for Construction?</h2>
        <p class="section-subtitle" style="margin-bottom: 30px;">
            Partner with SOLARAC Company LTD for prompt engineering tenders, transparent bill of quantities, and disciplined execution.
        </p>
        <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
            <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg">REQUEST A PROJECT BID</a>
            <a href="<?= url('contact.php') ?>" class="btn btn-navy btn-lg">CONTACT HEADQUARTERS</a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
