<?php
/**
 * SOLARAC Company LTD - Main Frontend Header
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/../config/config.php';

// Retrieve global site settings
$companyName    = setting('company_name', "SOLARAC Company LTD");
$tagline        = setting('tagline', "CIVIL ENGINEERING, BUILDING CONSTRUCTION & PROJECT MANAGEMENT");
$phonePrimary   = setting('phone_primary', '08035188495');
$phoneSecondary = setting('phone_secondary', '08065833345');
$emailPrimary   = setting('email_primary', 'info@solaraccompany.com');
$officeAddress  = setting('office_address', 'No 48, Baruwa Street, Opposite Old Governor\'s Office, Osogbo, Osun State, Nigeria');
$businessHours  = setting('business_hours', 'Mon - Fri: 8:00 AM - 6:00 PM | Sat: 9:00 AM - 4:00 PM');
$logoUrl        = setting('logo_url', 'assets/images/logo.png');
$faviconUrl     = setting('favicon_url', 'assets/images/logo.png');

// Dynamic SEO tags
$pageTitle       = $pageTitle ?? ($companyName . " | Civil Engineering & Building Construction");
$pageDescription = $pageDescription ?? ($tagline . ". Professional civil engineering, structural design, foundation works, and project management in Osogbo, Osun State, Lagos, and nationwide across Nigeria.");
$proto           = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$canonicalUrl    = $canonicalUrl ?? ($proto . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/'));
$ogImage         = $ogImage ?? asset('images/logo.png');

// Analytics IDs
$gaId = setting('analytics_ga_id', '');
$gtmId = setting('analytics_gtm_id', '');
$gscTag = setting('analytics_gsc_tag', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="keywords" content="SOLARAC Company LTD, civil engineering Nigeria, building construction Osogbo, structural design Osun State, raft foundation Lekki Lagos, project management, reinforced concrete fence, COREN registered contractors, RC 1175907">
    <link rel="canonical" href="<?= e($canonicalUrl) ?>">
    <link rel="icon" href="<?= upload_url($faviconUrl, 'assets/images/logo.png') ?>" type="image/png">

    <!-- Google Fonts: Outfit & Plus Jakarta Sans for Ultra-Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Open Graph / Meta -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonicalUrl) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($pageTitle) ?>">
    <meta name="twitter:description" content="<?= e($pageDescription) ?>">
    <meta name="twitter:image" content="<?= e($ogImage) ?>">

    <?php if (!empty($gscTag)): ?>
        <meta name="google-site-verification" content="<?= e($gscTag) ?>">
    <?php endif; ?>

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "GeneralContractor",
      "name": "<?= e($companyName) ?>",
      "legalName": "SOLARAC Company LTD",
      "alternateName": "SOLARAC Construction & Civil Engineering",
      "description": "<?= e($tagline) ?>",
      "identifier": "RC: 1175907",
      "url": "<?= e(BASE_URL) ?>",
      "logo": "<?= e(asset('images/logo.png')) ?>",
      "telephone": ["+234<?= ltrim($phonePrimary, '0') ?>", "+234<?= ltrim($phoneSecondary, '0') ?>"],
      "email": "<?= e($emailPrimary) ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "No 48, Baruwa Street, Opposite Old Governor's Office",
        "addressLocality": "Osogbo",
        "addressRegion": "Osun State",
        "addressCountry": "NG"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 7.7827,
        "longitude": 4.5418
      },
      "openingHours": "Mo-Fr 08:00-18:00, Sa 09:00-16:00",
      "serviceArea": ["Osun State", "Lagos State", "Oyo State", "Nigeria"],
      "priceRange": "$$$"
    }
    </script>

    <?php if (!empty($gtmId)): ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?= e($gtmId) ?>');</script>
    <!-- End Google Tag Manager -->
    <?php endif; ?>

    <?php if (!empty($gaId)): ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($gaId) ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?= e($gaId) ?>');
    </script>
    <?php endif; ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body>
    <a href="#mainContent" class="skip-link">Skip to main content</a>

    <!-- Top Utility Bar -->
    <div class="topbar">
        <div class="container topbar-inner">
            <div class="topbar-items">
                <span class="topbar-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span><?= e($officeAddress) ?></span>
                </span>
                <span class="topbar-item topbar-item-hours">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span><?= e($businessHours) ?></span>
                </span>
            </div>
            <div class="topbar-items topbar-actions">
                <span class="topbar-item">
                    <span class="rc-badge">RC: 1175907</span>
                </span>
                <span class="topbar-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    <a href="tel:<?= e($phonePrimary) ?>" class="topbar-phone"><?= e($phonePrimary) ?></a> | <a href="tel:<?= e($phoneSecondary) ?>" class="topbar-phone"><?= e($phoneSecondary) ?></a>
                </span>
                <span class="topbar-item">
                    <a href="<?= url('track.php') ?>" title="Track Request for Quotation" class="topbar-link">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span>Track RFQ</span>
                    </a>
                </span>
                <span class="topbar-item">
                    <a href="<?= admin_url('login.php') ?>" title="Administrative Portal Login" class="topbar-link" style="display: inline-flex; align-items: center; gap: 4px; color: var(--color-gold-300);">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <span>Admin Login</span>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="navbar" id="siteHeader">
        <div class="container navbar-inner">
            <a href="<?= url('') ?>" class="brand-logo" title="<?= e($companyName) ?>">
                <img src="<?= upload_url($logoUrl, 'assets/images/logo.png') ?>" alt="<?= e($companyName) ?> Logo" class="brand-logo-img">
                <div class="brand-logo-text">
                    <span class="brand-name">SOLARAC</span>
                    <span class="brand-sub">COMPANY LTD &bull; RC:1175907</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <?php include INCLUDES_PATH . 'navigation.php'; ?>

            <!-- Header Action CTA -->
            <div class="nav-cta">
                <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-quote" id="headerQuoteBtn">
                    <span>REQUEST A QUOTE</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                <button type="button" class="mobile-toggle" id="mobileNavToggle" aria-label="Toggle Navigation Menu" aria-expanded="false">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Global Notification Banner Container -->
    <div class="container" style="padding-top: 15px;">
        <?= render_flash() ?>
    </div>

    <main id="mainContent">
