<?php
/**
 * SOLARAC Company LTD - Certificates & Regulatory Accreditations
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$pageTitle = "Certificates & Regulatory Recognition | SOLARAC Company LTD";
$pageDescription = "Inspect SOLARAC Company LTD's official federal procurement registrations (BPP), FIRS tax compliance, PenCom, ITF, COREN accreditations, and the 2023 National Excellence Award in Civil Engineering.";

$companyName = setting('company_name', "SOLARAC Company LTD");
$rcNumber    = setting('rc_number', 'RC: 1175907');

include INCLUDES_PATH . 'header.php';
?>

<!-- Page Header -->
<div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #071221 0%, #0c203b 100%);">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <span class="section-tag section-tag-light" style="margin-bottom: 0;">VERIFIED CREDENTIALS</span>
            <span class="rc-badge"><?= e($rcNumber) ?></span>
        </div>
        <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;">Certificates &amp; Recognition</h1>
        <p style="color: #cbd5e1; max-width: 760px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
            Our official federal certifications, professional engineering affiliations, and industry honors demonstrating complete transparency and technical compliance.
        </p>
    </div>
</div>

<!-- 1. Federal & Regulatory Accreditations Grid -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">STATUTORY COMPLIANCE</span>
            <h2 class="section-title">Government &amp; Statutory Certifications</h2>
            <p class="section-subtitle">
                Click any certificate to inspect the verified high-resolution document in the interactive lightbox preview.
            </p>
        </div>

        <div class="cert-grid">
            <!-- 1. BPP Certificate -->
            <div class="cert-card">
                <div class="cert-thumb" data-lightbox-img="<?= asset('images/certificates/page24_img2.png') ?>" data-lightbox-title="Bureau of Public Procurement (BPP) Federal Contractor / Vendor Registration (IRR)">
                    <img src="<?= asset('images/certificates/page24_img2.png') ?>" alt="Bureau of Public Procurement Certificate" loading="lazy">
                    <button type="button" class="cert-zoom-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>Inspect Document</span>
                    </button>
                </div>
                <div class="cert-body">
                    <span class="cert-issuer">Federal Republic of Nigeria</span>
                    <h3>Bureau of Public Procurement (BPP)</h3>
                    <p>
                        Certified under the Interim Registration Report (IRR) by the Bureau of Public Procurement (BPP), demonstrating full compliance with federal procurement standards as an authorized public contractor and vendor.
                    </p>
                </div>
            </div>

            <!-- 2. FIRS Tax Certificate -->
            <div class="cert-card">
                <div class="cert-thumb" data-lightbox-img="<?= asset('images/certificates/page25_img2.png') ?>" data-lightbox-title="Federal Inland Revenue Service (FIRS) Tax Clearance & Compliance Certificate">
                    <img src="<?= asset('images/certificates/page25_img2.png') ?>" alt="FIRS Tax Certificate" loading="lazy">
                    <button type="button" class="cert-zoom-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>Inspect Document</span>
                    </button>
                </div>
                <div class="cert-body">
                    <span class="cert-issuer">Tax Authority</span>
                    <h3>FIRS Tax Compliance Certificate</h3>
                    <p>
                        Issued by the Federal Inland Revenue Service (FIRS), certifying full tax compliance, clean regulatory records, and trusted corporate fiscal governance.
                    </p>
                </div>
            </div>

            <!-- 3. PenCom Certificate -->
            <div class="cert-card">
                <div class="cert-thumb" data-lightbox-img="<?= asset('images/certificates/page26_img2.png') ?>" data-lightbox-title="National Pension Commission (PenCom) Certificate of Compliance">
                    <img src="<?= asset('images/certificates/page26_img2.png') ?>" alt="PenCom Certificate" loading="lazy">
                    <button type="button" class="cert-zoom-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>Inspect Document</span>
                    </button>
                </div>
                <div class="cert-body">
                    <span class="cert-issuer">Pension Authority</span>
                    <h3>National Pension Commission (PenCom)</h3>
                    <p>
                        Certificate of Compliance issued by PenCom confirming adherence to the Pension Reform Act and our corporate commitment to employee welfare and pension remittances.
                    </p>
                </div>
            </div>

            <!-- 4. ITF Certificate -->
            <div class="cert-card">
                <div class="cert-thumb" data-lightbox-img="<?= asset('images/certificates/Solarac-ITF.jpg') ?>" data-lightbox-title="Industrial Training Fund (ITF) Compliance Certificate">
                    <img src="<?= asset('images/certificates/Solarac-ITF.jpg') ?>" alt="ITF Certificate" loading="lazy">
                    <button type="button" class="cert-zoom-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>Inspect Document</span>
                    </button>
                </div>
                <div class="cert-body">
                    <span class="cert-issuer">Workforce Development</span>
                    <h3>Industrial Training Fund (ITF)</h3>
                    <p>
                        Certificate of Compliance issued by the Industrial Training Fund (ITF), confirming statutory workforce training contributions and commitment to human capital development in Nigeria.
                    </p>
                </div>
            </div>

            <!-- 5. Environmental Compliance -->
            <div class="cert-card">
                <div class="cert-thumb" data-lightbox-img="<?= asset('images/certificates/GOGO.png') ?>" data-lightbox-title="Environmental Impact Assessment & Compliance Certification">
                    <img src="<?= asset('images/certificates/GOGO.png') ?>" alt="Environmental Compliance Certificate" loading="lazy">
                    <button type="button" class="cert-zoom-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>Inspect Document</span>
                    </button>
                </div>
                <div class="cert-body">
                    <span class="cert-issuer">HSE &amp; Sustainability</span>
                    <h3>Environmental Impact &amp; Safety Compliance</h3>
                    <p>
                        Environmental compliance and impact mitigation assessment certifying that our civil and structural works adhere to environmental protection regulations.
                    </p>
                </div>
            </div>

            <!-- 6. National Excellence Award 2023 -->
            <div class="cert-card">
                <div class="cert-thumb" data-lightbox-img="<?= asset('images/certificates/unnamed (2).png') ?>" data-lightbox-title="National Excellence Award in Civil Engineering & Infrastructure Development (2023)">
                    <img src="<?= asset('images/certificates/unnamed (2).png') ?>" alt="National Excellence Award 2023" loading="lazy">
                    <button type="button" class="cert-zoom-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span>Inspect Document</span>
                    </button>
                </div>
                <div class="cert-body">
                    <span class="cert-issuer">Industry Recognition &bull; 2023</span>
                    <h3>National Excellence Award</h3>
                    <p>
                        National Excellence Award in Civil Engineering &amp; Infrastructure Development (2023) — recognizing our landmark project delivery, including Ataoja Model School of Science and coastal raft foundation works.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Professional Affiliations & Bodies -->
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">ENGINEERING BODIES</span>
            <h2 class="section-title">Professional Affiliations &amp; Accreditations</h2>
            <p class="section-subtitle">
                Our active memberships and continuous technical alignment with Nigeria's premier engineering institutions.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 28px; border: 1px solid var(--color-gray-200);">
                <div style="font-weight: 800; font-family: var(--font-heading); color: var(--color-primary-900); font-size: 1.2rem; margin-bottom: 8px;">
                    COREN
                </div>
                <strong style="color: var(--color-accent-600); font-size: 0.85rem; display: block; margin-bottom: 8px;">Council for the Regulation of Engineering in Nigeria</strong>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Accredited and registered by Nigeria's statutory regulatory body for engineering practice, ensuring technical accountability and strict engineering code compliance.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 28px; border: 1px solid var(--color-gray-200);">
                <div style="font-weight: 800; font-family: var(--font-heading); color: var(--color-primary-900); font-size: 1.2rem; margin-bottom: 8px;">
                    NSE
                </div>
                <strong style="color: var(--color-accent-600); font-size: 0.85rem; display: block; margin-bottom: 8px;">Nigerian Society of Engineers</strong>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Active corporate and individual fellowship memberships in the premier umbrella body for Nigerian engineering practitioners.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 28px; border: 1px solid var(--color-gray-200);">
                <div style="font-weight: 800; font-family: var(--font-heading); color: var(--color-primary-900); font-size: 1.2rem; margin-bottom: 8px;">
                    NICE
                </div>
                <strong style="color: var(--color-accent-600); font-size: 0.85rem; display: block; margin-bottom: 8px;">Nigerian Institution of Civil Engineers</strong>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Fellowship and chartered division membership promoting advanced civil engineering practice, structural innovation, and geotechnical best practices.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 28px; border: 1px solid var(--color-gray-200);">
                <div style="font-weight: 800; font-family: var(--font-heading); color: var(--color-primary-900); font-size: 1.2rem; margin-bottom: 8px;">
                    ACEN
                </div>
                <strong style="color: var(--color-accent-600); font-size: 0.85rem; display: block; margin-bottom: 8px;">Association of Consulting Engineers Nigeria</strong>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Consulting engineering standard alignment fostering professional ethics, independent supervision, and design reliability.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 28px; border: 1px solid var(--color-gray-200);">
                <div style="font-weight: 800; font-family: var(--font-heading); color: var(--color-primary-900); font-size: 1.2rem; margin-bottom: 8px;">
                    NIOB
                </div>
                <strong style="color: var(--color-accent-600); font-size: 0.85rem; display: block; margin-bottom: 8px;">Nigerian Institute of Building</strong>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Commitment to building construction standards, quality workmanship, and structural durability across residential and commercial developments.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 28px; border: 1px solid var(--color-gray-200);">
                <div style="font-weight: 800; font-family: var(--font-heading); color: var(--color-primary-900); font-size: 1.2rem; margin-bottom: 8px;">
                    FOCI
                </div>
                <strong style="color: var(--color-accent-600); font-size: 0.85rem; display: block; margin-bottom: 8px;">Federation of Construction Industry</strong>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Active involvement in construction industry advocacy, labor standards, fair contracting, and infrastructural growth in Nigeria.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 3. Direct RFQ Call to Action -->
<section class="section">
    <div class="container" style="text-align: center; max-width: 780px;">
        <span class="section-tag">TRUST IN OUR CREDENTIALS</span>
        <h2 class="section-title">Ready to Execute With a Fully Certified Contractor?</h2>
        <p class="section-subtitle" style="margin-bottom: 30px;">
            Work with an accredited civil engineering firm that guarantees statutory compliance, structural excellence, and transparent procurement from day one.
        </p>
        <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
            <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg">REQUEST A PROJECT QUOTE</a>
            <a href="<?= url('contact.php') ?>" class="btn btn-navy btn-lg">CONTACT HEADQUARTERS</a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
