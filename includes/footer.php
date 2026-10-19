<?php
/**
 * SOLARAC Company LTD - Main Frontend Footer
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
$companyName    = setting('company_name', "SOLARAC Company LTD");
$tagline        = setting('tagline', "CIVIL ENGINEERING, BUILDING CONSTRUCTION & PROJECT MANAGEMENT");
$motto          = setting('motto', "Building the Future with Integrity, Innovation and Excellence.");
$phonePrimary   = setting('phone_primary', '08035188495');
$phoneSecondary = setting('phone_secondary', '08065833345');
$emailPrimary   = setting('email_primary', 'info@solaraccompany.com');
$officeAddress  = setting('office_address', 'No 48, Baruwa Street, Opposite Old Governor\'s Office, Osogbo, Osun State, Nigeria');
$rcNumber       = setting('rc_number', 'RC: 1175907');
$whatsappNum    = setting('whatsapp_number', '2348035188495');
$whatsappMsg    = setting('whatsapp_message', 'Hello SOLARAC Company LTD, I would like to inquire about your civil engineering and construction services.');
$whatsappActive = Settings::getBool('whatsapp_enabled', true);
$currentYear    = date('Y');
?>
    </main>

    <!-- Floating WhatsApp Action -->
    <?php if ($whatsappActive && !empty($whatsappNum)): ?>
    <a href="https://wa.me/<?= e($whatsappNum) ?>?text=<?= urlencode($whatsappMsg) ?>" 
       class="floating-whatsapp" 
       target="_blank" 
       rel="noopener noreferrer" 
       title="Chat with SOLARAC Engineering Team on WhatsApp">
        <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor">
            <path d="M12.031 2C6.495 2 2 6.496 2 12.033c0 1.98.577 3.827 1.575 5.385L2.348 22l4.743-1.229a10.007 10.007 0 0 0 4.94 1.265h.004c5.536 0 10.031-4.496 10.031-10.033C22.066 6.496 17.571 2 12.031 2zm5.836 14.199c-.244.688-1.42 1.309-1.97 1.393-.51.077-1.168.109-3.791-.983-3.354-1.397-5.512-4.832-5.68-5.056-.168-.224-1.36-1.81-1.36-3.453 0-1.642.862-2.451 1.168-2.787.306-.336.669-.42.892-.42.224 0 .448.002.645.012.208.01.488-.078.763.582.285.688.97 2.37.1054 2.542.084.172.14.374.028.598-.112.224-.168.364-.336.56-.168.196-.353.438-.504.588-.168.168-.344.351-.148.688.196.336.872 1.436 1.87 2.325 1.284 1.144 2.365 1.498 2.701 1.666.336.168.532.14.73-.084.196-.224.84-0.98.1064-1.316.224-.336.448-.28.756-.168.308.112 1.956.923 2.292 1.091.336.168.56.252.644.392.084.14.084.812-.16 1.5z"/>
        </svg>
        <span>Chat with Us</span>
    </a>
    <?php endif; ?>

    <!-- Corporate Footer -->
    <footer class="site-footer">
        <div class="footer-top-accent"></div>
        <div class="container footer-grid">
            <!-- Company Overview & Positioning -->
            <div class="footer-about">
                <a href="<?= url('') ?>" class="footer-brand">
                    <img src="<?= asset('images/logo.png') ?>" alt="<?= e($companyName) ?> Logo" class="footer-logo">
                    <div>
                        <span class="footer-brand-title">SOLARAC COMPANY LTD</span>
                        <span class="footer-brand-rc"><?= e($rcNumber) ?></span>
                    </div>
                </a>
                <p class="footer-desc">
                    <strong><?= e($companyName) ?></strong> (RC: 1175907) is an indigenous civil engineering, building construction, and project management enterprise delivering high-caliber infrastructure across Nigeria with integrity, innovation, and technical excellence.
                </p>
                <div class="footer-creds">
                    <span class="cred-pill"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg> BPP Registered (IRR)</span>
                    <span class="cred-pill"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg> COREN / NSE Standard</span>
                    <span class="cred-pill"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg> PenCom &amp; ITF Compliant</span>
                </div>
            </div>

            <!-- Quick Navigation -->
            <div class="footer-nav">
                <h4 class="footer-title">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="<?= url('') ?>">Home</a></li>
                    <li><a href="<?= url('about.php') ?>">About SOLARAC</a></li>
                    <li><a href="<?= url('services.php') ?>">Engineering Services</a></li>
                    <li><a href="<?= url('projects.php') ?>">Project Portfolio</a></li>
                    <li><a href="<?= url('certificates.php') ?>">Certificates &amp; Recognition</a></li>
                    <li><a href="<?= url('team.php') ?>">Meet The Team</a></li>
                    <li><a href="<?= url('blog.php') ?>">Technical Insights</a></li>
                    <li><a href="<?= url('track.php') ?>">Track Project / RFQ</a></li>
                    <li><a href="<?= url('contact.php') ?>">Contact Us</a></li>
                    <li><a href="<?= admin_url('login.php') ?>" style="color: var(--color-gold-400); font-weight: 700;"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: -2px; margin-right: 5px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>Admin Portal Login</a></li>
                </ul>
            </div>

            <!-- Core Engineering Services -->
            <div class="footer-sectors">
                <h4 class="footer-title">Our Services</h4>
                <ul class="footer-links">
                    <li><a href="<?= url('services.php#project-management') ?>">Project Management &amp; EPC</a></li>
                    <li><a href="<?= url('services.php#civil-construction') ?>">Civil &amp; Building Construction</a></li>
                    <li><a href="<?= url('services.php#foundation-engineering') ?>">Raft &amp; Sub-Structure Works</a></li>
                    <li><a href="<?= url('services.php#reinforced-concrete-fencing') ?>">Reinforced Concrete Fencing</a></li>
                    <li><a href="<?= url('services.php#transportation-hydraulic-engineering') ?>">Transportation &amp; Highways</a></li>
                    <li><a href="<?= url('services.php#facilities-management-telecom') ?>">Facilities &amp; Telecom Masts</a></li>
                </ul>
            </div>

            <!-- Headquarters & Contact Information -->
            <div class="footer-contact">
                <h4 class="footer-title">Headquarters</h4>
                <ul class="footer-contact-list">
                    <li>
                        <div class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div class="contact-text">
                            <strong>Head Office:</strong><br>
                            <?= e($officeAddress) ?>
                        </div>
                    </li>
                    <li>
                        <div class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="contact-text">
                            <strong>Phone Lines:</strong><br>
                            <a href="tel:<?= e($phonePrimary) ?>"><?= e($phonePrimary) ?></a><br>
                            <a href="tel:<?= e($phoneSecondary) ?>"><?= e($phoneSecondary) ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="contact-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div class="contact-text">
                            <strong>Official Email:</strong><br>
                            <a href="mailto:<?= e($emailPrimary) ?>"><?= e($emailPrimary) ?></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <div class="footer-copy">
                    &copy; <?= $currentYear ?> <strong><?= e($companyName) ?></strong> (<?= e($rcNumber) ?>). All rights reserved.
                    <span class="powered-by">
                        &bull; Powered by <a href="https://www.cloudcurrentng.com" target="_blank" rel="noopener noreferrer">www.cloudcurrentng.com</a>
                    </span>
                </div>
                <div class="footer-legal-links">
                    <a href="<?= url('privacy.php') ?>">Privacy Policy</a>
                    <a href="<?= url('terms.php') ?>">Terms of Engagement</a>
                    <a href="<?= url('cookie-policy.php') ?>">Cookie Policy</a>
                    <a href="<?= url('disclaimer.php') ?>">Disclaimer</a>
                    <a href="<?= admin_url('login.php') ?>" class="footer-admin-link">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <span>Admin Login</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Image Lightbox Modal -->
    <div class="lightbox-modal" id="globalLightboxModal" role="dialog" aria-modal="true">
        <div class="lightbox-content">
            <div class="lightbox-img-wrap">
                <img src="" id="lightboxModalImg" alt="Enlarged View">
            </div>
            <div class="lightbox-footer">
                <div class="lightbox-title" id="lightboxModalTitle">Image Preview</div>
                <button type="button" class="lightbox-close-btn" aria-label="Close Preview">Close &times;</button>
            </div>
        </div>
    </div>

    <!-- Global RFQ Quick Modal -->
    <?php include INCLUDES_PATH . 'rfq-modal.php'; ?>

    <!-- Core Scripts -->
    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
