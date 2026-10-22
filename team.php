<?php
/**
 * SOLARAC Company LTD - Meet The Team
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$pageTitle = "Meet Our Engineering Leadership & Team | SOLARAC Company LTD";
$pageDescription = "Meet the certified civil engineers, structural designers, project managers, and construction leaders driving excellence at SOLARAC Company LTD (RC: 1175907).";

$team = Database::fetchAll("SELECT * FROM `team_members` WHERE `status` = 'active' ORDER BY `sort_order` ASC");

include INCLUDES_PATH . 'header.php';
?>

<!-- Page Header -->
<div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #04100c 0%, #081d15 100%);">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <span class="section-tag section-tag-light" style="margin-bottom: 0;">TECHNICAL LEADERSHIP</span>
            <span class="rc-badge">RC: 1175907</span>
        </div>
        <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;">Meet Our Professional Team</h1>
        <p style="color: #cbd5d0; max-width: 760px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
            The experienced civil engineers, structural specialists, and project governance leaders driving precision and structural durability across every project.
        </p>
    </div>
</div>

<!-- 1. Team Grid -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">OUR PERSONNEL</span>
            <h2 class="section-title">Civil Engineering Leadership &amp; Specialists</h2>
            <p class="section-subtitle">
                Certified under COREN, Nigerian Society of Engineers (NSE), and federal professional boards.
            </p>
        </div>

        <div class="team-grid">
            <!-- 1. Engr. Bashiru Abiola Saliu -->
            <div class="team-card">
                <div class="team-header">
                    <div class="team-avatar-box">BS</div>
                    <div class="team-title-wrap">
                        <h3>Engr. Bashiru Abiola Saliu</h3>
                        <span class="team-role-tag">Managing Partner &bull; MNSE, FNICE</span>
                    </div>
                </div>
                <p class="team-bio">
                    Engr. Bashiru Abiola Saliu MNSE, FNICE brings nearly 20 years of sterling experience in civil engineering. His expertise spans structural design and construction, project management, financial management, and human resource management across major infrastructure projects throughout Nigeria.
                </p>
                <ul class="team-meta-list">
                    <li><strong>Expertise:</strong> Structural Design, Project Governance, Financial Oversight</li>
                    <li><strong>Experience:</strong> Roads, bridges, educational complexes, telecom base stations</li>
                    <li><strong>Credentials:</strong> MNSE, FNICE &bull; Advanced HSE &bull; EIA Certified</li>
                </ul>
            </div>

            <!-- 2. Engr. Odebunmi Babawale -->
            <div class="team-card">
                <div class="team-header">
                    <div class="team-avatar-box">OB</div>
                    <div class="team-title-wrap">
                        <h3>Engr. Odebunmi Babawale</h3>
                        <span class="team-role-tag">Managing Director</span>
                    </div>
                </div>
                <p class="team-bio">
                    Engr. Babawale serves as Managing Director with extensive experience in structural engineering, technical team management, and corporate business development. He directs technical engineering teams to ensure innovative, cost-effective solutions are implemented in every project.
                </p>
                <ul class="team-meta-list">
                    <li><strong>Expertise:</strong> Structural Engineering, Technical Direction, Business Strategy</li>
                    <li><strong>Education:</strong> B.Tech Structural Engineering &bull; M.Eng Construction Management</li>
                    <li><strong>Focus:</strong> Structural Integrity, Eurocode &amp; BS Compliance</li>
                </ul>
            </div>

            <!-- 3. Engr. Salam B.H -->
            <div class="team-card">
                <div class="team-header">
                    <div class="team-avatar-box">SH</div>
                    <div class="team-title-wrap">
                        <h3>Engr. Salam B.H</h3>
                        <span class="team-role-tag">Senior Project Manager &bull; PMP</span>
                    </div>
                </div>
                <p class="team-bio">
                    Engr. Salam coordinates complex civil construction projects from inception to completion. His rigorous project management methodology, quality control schedules, and contractor supervision guarantee timely delivery and full client satisfaction.
                </p>
                <ul class="team-meta-list">
                    <li><strong>Expertise:</strong> Project Management, Quality Control, Site Coordination</li>
                    <li><strong>Education:</strong> B.Tech Civil Engineering &bull; PMP Certification</li>
                    <li><strong>Specialty:</strong> Critical Path Method (CPM) Scheduling &amp; Milestone Control</li>
                </ul>
            </div>

            <!-- 4. Engr. Ogunsadekoya Samuel -->
            <div class="team-card">
                <div class="team-header">
                    <div class="team-avatar-box">OS</div>
                    <div class="team-title-wrap">
                        <h3>Engr. Ogunsadekoya Samuel</h3>
                        <span class="team-role-tag">Project Lead &bull; Safety Manager</span>
                    </div>
                </div>
                <p class="team-bio">
                    Engr. Samuel leads our on-site field operations, supervising heavy civil construction activities and enforcing strict occupational safety protocols. His hands-on technical supervision ensures zero-incident project execution.
                </p>
                <ul class="team-meta-list">
                    <li><strong>Expertise:</strong> Field Operations, Safety Management, Technical Supervision</li>
                    <li><strong>Education:</strong> B.Tech Civil Engineering &bull; Safety Management Certification</li>
                    <li><strong>Focus:</strong> Site HSE Protocols, Rebar Quality, Concrete Pour Supervision</li>
                </ul>
            </div>

            <!-- 5. Ajibade Taofeek Oladayo -->
            <div class="team-card" style="grid-column: 1 / -1;">
                <div class="team-specialist-layout">
                    <div style="text-align: center; background: #f8fafc; border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 12px; cursor: pointer;" data-lightbox-img="<?= asset('images/certificates/TAOFEEK-CERT.png') ?>" data-lightbox-title="Federal Ministry of Labour - Painting & Decorating Trade Certificate">
                        <img src="<?= asset('images/certificates/TAOFEEK-CERT.png') ?>" alt="Trade Test Certificate" style="max-width: 100%; height: 160px; object-fit: contain; display: block; margin: 0 auto; border-radius: 6px;">
                        <span style="font-size: 0.72rem; color: var(--color-accent-600); font-weight: 700; margin-top: 6px; display: block;">Click to Zoom Certificate</span>
                    </div>
                    <div>
                        <div class="team-header" style="margin-bottom: 12px;">
                            <div class="team-title-wrap">
                                <h3>Ajibade Taofeek Oladayo</h3>
                                <span class="team-role-tag">Certified Painting &amp; Decorating Specialist</span>
                            </div>
                        </div>
                        <p class="team-bio">
                            Ajibade is a certified painting and decorating specialist with strong attention to detail and expertise in durable, weather-resistant, and high-aesthetic architectural finishes for both commercial superstructures and luxury residential projects.
                        </p>
                        <ul class="team-meta-list">
                            <li><strong>Expertise:</strong> Surface preparation, priming, decorative coatings, protective anti-weathering finishes</li>
                            <li><strong>Certification:</strong> Painting &amp; Decorating Certificate &mdash; Federal Ministry of Labour and Employment</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 6. Afolabi Titilope Busayo -->
            <div class="team-card" style="grid-column: 1 / -1;">
                <div class="team-specialist-layout">
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <!-- Certificate 1: Federal Ministry of Labour and Productivity (2017) -->
                        <div style="text-align: center; background: #f8fafc; border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 10px; cursor: pointer; transition: all 0.2s ease;" data-lightbox-img="<?= asset('images/certificates/AFOLABI-LABOUR-CERT.png') ?>" data-lightbox-title="Federal Ministry of Labour &amp; Productivity - Carpenter &amp; Joiner Trade Test Certificate III (Issued 2017)">
                            <img src="<?= asset('images/certificates/AFOLABI-LABOUR-CERT.png') ?>" alt="Trade Test Certificate III (2017)" style="max-width: 100%; height: 85px; object-fit: contain; display: block; margin: 0 auto; border-radius: 6px;">
                            <span style="font-size: 0.7rem; color: var(--color-accent-600); font-weight: 700; margin-top: 4px; display: block;">Federal Labour Cert III (2017)</span>
                        </div>
                        <!-- Certificate 2: Federal Science and Technical College Yaba Lagos (2020) -->
                        <div style="text-align: center; background: #f8fafc; border: 1px solid var(--color-gray-200); border-radius: 12px; padding: 10px; cursor: pointer; transition: all 0.2s ease;" data-lightbox-img="<?= asset('images/certificates/AFOLABI-FSTC-CERT.png') ?>" data-lightbox-title="Federal Science and Technical College (FSTC) Yaba Lagos - Certificate III in Carpentry &amp; Joinery (Issued 2020)">
                            <img src="<?= asset('images/certificates/AFOLABI-FSTC-CERT.png') ?>" alt="FSTC Yaba Lagos Certificate III (2020)" style="max-width: 100%; height: 85px; object-fit: contain; display: block; margin: 0 auto; border-radius: 6px;">
                            <span style="font-size: 0.7rem; color: var(--color-accent-600); font-weight: 700; margin-top: 4px; display: block;">FSTC Yaba Lagos Cert III (2020)</span>
                        </div>
                    </div>
                    <div>
                        <div class="team-header" style="margin-bottom: 12px;">
                            <div class="team-title-wrap">
                                <h3>Afolabi Titilope Busayo</h3>
                                <span class="team-role-tag">Certified Carpenter &amp; Joiner Specialist</span>
                            </div>
                        </div>
                        <p class="team-bio">
                            Afolabi is a certified carpentry and joinery craftswoman with extensive technical expertise in structural timber formwork, precision architectural joinery, reinforced concrete shuttering, and bespoke roof truss systems for heavy civil structures and modern architectural developments.
                        </p>
                        <ul class="team-meta-list">
                            <li><strong>Expertise:</strong> Structural timber framing, formwork &amp; falsework assembly, roof trusses, architectural woodwork, joinery &amp; cabinetry</li>
                            <li><strong>Certification 1:</strong> Trade Test Certificate Class III (Carpenter &amp; Joiner) &mdash; Federal Ministry of Labour and Productivity (Issued 2017)</li>
                            <li><strong>Certification 2:</strong> Certificate III in Carpentry &amp; Joinery &mdash; Federal Science and Technical College (FSTC), Yaba, Lagos (Issued 2020)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Team Values Section -->
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">CULTURE OF EXCELLENCE</span>
            <h2 class="section-title">The Principles That Unite Our Engineering Team</h2>
            <p class="section-subtitle">
                Core operational values that guarantee consistency across our design offices and active job sites.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 30px; border: 1px solid var(--color-gray-200);">
                <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Interdisciplinary Collaboration</h3>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    We integrate structural engineers, quantity surveyors, geotechnical experts, and field leads as a unified unit to eliminate misunderstandings and ensure cohesive execution.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 30px; border: 1px solid var(--color-gray-200);">
                <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Continuous Technical Learning</h3>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    Our staff continuously undergoes training through NSE, COREN, and ITF programs, keeping our methods aligned with the latest Eurocodes and materials technology.
                </p>
            </div>

            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 30px; border: 1px solid var(--color-gray-200);">
                <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <h3 style="font-size: 1.2rem; margin-bottom: 10px;">Engineering Innovation</h3>
                <p style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.6; margin-bottom: 0;">
                    From optimized continuous raft rebar patterns to fair-faced architectural concrete formulations, we adopt innovative methods that reduce costs and prolong building lifespan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 3. Direct RFQ Call to Action -->
<section class="section">
    <div class="container" style="text-align: center; max-width: 780px;">
        <span class="section-tag">WORK WITH OUR TEAM</span>
        <h2 class="section-title">Ready to Partner With Our Engineering Experts?</h2>
        <p class="section-subtitle" style="margin-bottom: 30px;">
            Let our experienced civil engineers review your site requirements, structural drawings, or bill of quantities.
        </p>
        <div style="display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
            <a href="<?= url('quote.php') ?>" class="btn btn-primary btn-lg">REQUEST A PROJECT ESTIMATE</a>
            <a href="<?= url('contact.php') ?>" class="btn btn-navy btn-lg">SPEAK WITH AN ENGINEER</a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
