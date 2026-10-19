<?php
/**
 * SOLARAC Company LTD - About Us Page
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$pageTitle = "About SOLARAC Company LTD | Civil Engineering & Construction Firm";
$pageDescription = "Discover SOLARAC Company LTD (RC: 1175907), our corporate foundation, civil engineering leadership, mission, vision, quality assurance, and HSE standards in Osogbo, Osun State, Nigeria.";

$companyName     = setting('company_name', "SOLARAC Company LTD");
$rcNumber        = setting('rc_number', 'RC: 1175907');
$officeAddress   = setting('office_address', "No 48, Baruwa Street, Opposite Old Governor's Office, Osogbo, Osun State, Nigeria");
$phonePrimary    = setting('phone_primary', '08035188495');
$phoneSecondary  = setting('phone_secondary', '08065833345');
$emailPrimary    = setting('email_primary', 'info@solaraccompany.com');

include INCLUDES_PATH . 'header.php';
?>

<!-- Hero Banner -->
<div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #04100c 0%, #081d15 100%);">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <span class="section-tag section-tag-light" style="margin-bottom: 0;">CORPORATE PROFILE</span>
            <span class="rc-badge"><?= e($rcNumber) ?></span>
        </div>
        <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;">About SOLARAC Company LTD</h1>
        <p style="color: #cbd5d0; max-width: 780px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
            Building the future with integrity, innovation, and technical excellence. A licensed Nigerian civil and building construction firm committed to high-impact infrastructure.
        </p>
    </div>
</div>

<!-- 1. Corporate Overview & Governance -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 48px; align-items: start;">
            <div>
                <span class="section-tag">WHO WE ARE</span>
                <h2 class="section-title">Engineered for Durability, Managed with Discipline</h2>
                <div style="font-size: 1.05rem; line-height: 1.75; color: var(--color-dark-700);">
                    <p>
                        <strong>SOLARAC Company Limited (RC: 1175907)</strong> is a Limited Liability Company incorporated to deliver exceptional expertise in Project Management, Civil Engineering and Construction, General Facilities Management, and General Contract Services. Headquartered in Osogbo, Osun State, we have built an enduring reputation for delivering high-quality projects that meet and exceed international benchmarks.
                    </p>
                    <p>
                        We are managed by a multi-disciplinary team of certified professionals with extensive backgrounds in structural design, geotechnical foundation analysis, road construction, telecom mast construction, facility maintenance, and financial project governance.
                    </p>
                    <p>
                        At SOLARAC, we are passionate about civil engineering and committed to precision in project delivery. As an accredited construction contractor, we maintain the highest standards of professionalism, occupational safety, and environmental stewardship across all operations.
                    </p>
                </div>

                <div style="margin-top: 32px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="background: var(--color-gray-100); padding: 22px; border-radius: var(--radius-md); border-left: 4px solid var(--color-accent-500);">
                        <h4 style="font-size: 1rem; margin-bottom: 6px; color: var(--color-primary-900);">Statutory Accreditation</h4>
                        <div style="font-size: 0.88rem; color: var(--color-dark-600); line-height: 1.55;">
                            Corporate Affairs: <strong><?= e($rcNumber) ?></strong><br>
                            Procurement: <strong>BPP Federal IRR Certified</strong><br>
                            Tax: <strong>FIRS Fully Compliant</strong>
                        </div>
                    </div>
                    <div style="background: var(--color-gray-100); padding: 22px; border-radius: var(--radius-md); border-left: 4px solid var(--color-primary-900);">
                        <h4 style="font-size: 1rem; margin-bottom: 6px; color: var(--color-primary-900);">Operational Base</h4>
                        <div style="font-size: 0.88rem; color: var(--color-dark-600); line-height: 1.55;">
                            <?= e($officeAddress) ?><br>
                            Operational reach across South-West &amp; Nationwide
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Card: Mission & Vision -->
            <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-lg); padding: 36px; box-shadow: var(--shadow-md);">
                <div style="margin-bottom: 30px;">
                    <div style="display: inline-flex; align-items: center; gap: 8px; color: var(--color-accent-500); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="12 8 8 12 12 16 16 12 12 8"></polygon></svg>
                        OUR MISSION
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 10px;">Building With Purpose</h3>
                    <p style="font-size: 0.95rem; color: var(--color-dark-600); line-height: 1.65; margin-bottom: 0;">
                        At SOLARAC, our mission is to build the Future with Integrity, Innovation and Excellence. We are dedicated to delivering High-Quality Construction Solutions that not only meet but exceed our Clients' expectations by fostering a Culture of Safety, Sustainability and Collaboration to create long-lasting structures that enhance the COMMUNITIES we serve.
                    </p>
                </div>

                <div style="border-top: 1px solid var(--color-gray-200); padding-top: 24px; margin-bottom: 30px;">
                    <div style="display: inline-flex; align-items: center; gap: 8px; color: var(--color-accent-500); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        OUR VISION
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 10px;">Aiming for Leadership</h3>
                    <p style="font-size: 0.95rem; color: var(--color-dark-600); line-height: 1.65; margin-bottom: 0;">
                        Our vision is to be a Trusted Leader in the Construction and Real Estate Industry, delivering Exceptional Quality, Innovative Solutions and Lasting Values for Our Clients and Communities throughout Nigeria.
                    </p>
                </div>

                <div style="border-top: 1px solid var(--color-gray-200); padding-top: 24px;">
                    <div style="display: inline-flex; align-items: center; gap: 8px; color: var(--color-accent-500); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                        OUR CORE VALUES
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
                        <span style="background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); padding: 5px 12px; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">Integrity</span>
                        <span style="background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); padding: 5px 12px; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">Innovation</span>
                        <span style="background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); padding: 5px 12px; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">Excellence</span>
                        <span style="background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); padding: 5px 12px; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">Safety First</span>
                        <span style="background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); padding: 5px 12px; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">Sustainability</span>
                        <span style="background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); padding: 5px 12px; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700;">Collaboration</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. What Sets SOLARAC Apart -->
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">THE SOLARAC DIFFERENCE</span>
            <h2 class="section-title">What Sets Us Apart in the Construction Industry</h2>
            <p class="section-subtitle">
                Our combination of veteran engineering leadership, modern construction methodology, and strict statutory compliance.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;">
            <div style="background: var(--color-white); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--color-gray-200); box-shadow: var(--shadow-sm);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Proven Track Record</h3>
                <p style="font-size: 0.92rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    We have successfully completed numerous landmark projects across educational, industrial, and residential sectors, consistently delivering results that meet or exceed client expectations.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--color-gray-200); box-shadow: var(--shadow-sm);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Expert Engineering Team</h3>
                <p style="font-size: 0.92rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Our team comprises certified engineers (COREN, MNSE, FNICE, PMP) and construction professionals with extensive experience in structural design, hydraulic systems, and project management.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--color-gray-200); box-shadow: var(--shadow-sm);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Modern Technology &amp; Methods</h3>
                <p style="font-size: 0.92rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    We utilize the latest structural analysis software, precision surveying equipment, and durable casting methodologies to ensure efficient project execution and superior structural life.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--color-gray-200); box-shadow: var(--shadow-sm);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Timely Milestone Delivery</h3>
                <p style="font-size: 0.92rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    We understand that delays increase costs. We implement strict Critical Path Method (CPM) project governance to guarantee handover according to agreed project schedules.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--color-gray-200); box-shadow: var(--shadow-sm);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Cost-Effective Solutions</h3>
                <p style="font-size: 0.92rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Our strategic procurement channels and material waste-reduction techniques ensure clients receive maximum value for their construction investment without cutting structural corners.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--color-gray-200); box-shadow: var(--shadow-sm);">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Uncompromising Safety First</h3>
                <p style="font-size: 0.92rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Safety is our highest operational priority. We maintain strict site HSE guidelines, environmental impact assessment compliance, and certified protective equipment for all personnel.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 3. Leadership & Team Spotlight Link -->
<section class="section">
    <div class="container">
        <div style="background: linear-gradient(135deg, var(--color-primary-950) 0%, var(--color-primary-900) 100%); border-radius: var(--radius-lg); padding: 50px 40px; color: #fff; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px;">
            <div style="max-width: 680px;">
                <span class="section-tag section-tag-light">LEADERSHIP EXCELLENCE</span>
                <h2 style="color: #fff; font-size: 2.2rem; margin: 10px 0 14px;">Led by Experienced Engineering Partners</h2>
                <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.65; margin-bottom: 0;">
                    Under the technical helm of <strong>Engr. Bashiru Abiola Saliu (MNSE, FNICE)</strong> and <strong>Engr. Odebunmi Babawale</strong>, SOLARAC brings nearly two decades of combined civil engineering experience in infrastructure, roads, multi-story buildings, and specialized foundations.
                </p>
            </div>
            <div>
                <a href="<?= url('team.php') ?>" class="btn btn-primary btn-lg">
                    <span>Meet Our Full Technical Team &rarr;</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 4. Direct RFQ Call to Action -->
<section class="section section-gray">
    <div class="container" style="text-align: center; max-width: 780px;">
        <span class="section-tag">PARTNER WITH US</span>
        <h2 class="section-title">Ready to Discuss Your Construction Project?</h2>
        <p class="section-subtitle" style="margin-bottom: 30px;">
            Whether you require geotechnical foundation engineering, complete building construction, or industrial concrete fencing, our team is ready to consult.
        </p>
        <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
            <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg">REQUEST A QUOTE</a>
            <a href="<?= url('contact.php') ?>" class="btn btn-navy btn-lg">CONTACT HEADQUARTERS</a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
