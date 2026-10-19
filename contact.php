<?php
/**
 * SOLARAC Company LTD - Contact Headquarters
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$pageTitle = "Contact Us | SOLARAC Company LTD - Osogbo, Osun State, Nigeria";
$pageDescription = "Get in touch with SOLARAC Company LTD headquarters in Osogbo, Osun State. Contact our civil engineers, project directors, and site supervisors.";

$companyName    = setting('company_name', "SOLARAC Company LTD");
$officeAddress  = setting('office_address', "No 48, Baruwa Street, Opposite Old Governor's Office, Osogbo, Osun State, Nigeria");
$phonePrimary   = setting('phone_primary', '08035188495');
$phoneSecondary = setting('phone_secondary', '08065833345');
$emailPrimary   = setting('email_primary', 'info@solaraccompany.com');
$businessHours  = setting('business_hours', 'Monday - Friday: 8:00 AM - 6:00 PM | Saturday: 9:00 AM - 4:00 PM');
$googleMaps     = setting('google_maps_embed', '');

$success = false;
$errorMessage = '';

// Load FAQs
$faqs = Database::fetchAll("SELECT * FROM `faqs` WHERE `status` = 'published' ORDER BY `sort_order` ASC LIMIT 6");

// Process form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::validateOrAbort();

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $errorMessage = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Please provide a valid email address.";
    } else {
        try {
            $msgId = Database::insert('contact_messages', [
                'name'       => $name,
                'email'      => $email,
                'phone'      => $phone ?: null,
                'subject'    => $subject,
                'message'    => $message,
                'is_read'    => 0,
                'is_archived'=> 0,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            try {
                Mailer::sendContactAdminAlert([
                    'name'    => $name,
                    'email'   => $email,
                    'phone'   => $phone,
                    'subject' => $subject,
                    'message' => $message
                ]);
            } catch (Exception $e) {
                error_log("Contact notification notice: " . $e->getMessage());
            }

            $success = true;
        } catch (Exception $e) {
            error_log("Contact message error: " . $e->getMessage());
            $errorMessage = "Failed to transmit message. Please call our lines directly at 08035188495.";
        }
    }
}

include INCLUDES_PATH . 'header.php';
?>

<div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #04100c 0%, #081d15 100%);">
    <div class="container">
        <span class="section-tag section-tag-light">GET IN TOUCH</span>
        <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;">Contact Our Corporate Headquarters</h1>
        <p style="color: #cbd5d0; max-width: 760px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
            Connect directly with our civil engineers, structural designers, and project management team in Osogbo, Osun State, Nigeria.
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1.2fr 1.8fr; gap: 48px; align-items: start;">
            <!-- Corporate Contact Cards -->
            <div>
                <h3 style="font-size: 1.45rem; margin-bottom: 24px; color: var(--color-primary-900);">Headquarters Information</h3>

                <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 26px; margin-bottom: 20px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; gap: 14px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h4 style="font-size: 1.05rem; margin-bottom: 6px; color: var(--color-primary-900);">Physical Address</h4>
                            <p style="font-size: 0.92rem; color: var(--color-dark-600); margin-bottom: 0; line-height: 1.6;">
                                <?= e($officeAddress) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 26px; margin-bottom: 20px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; gap: 14px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <h4 style="font-size: 1.05rem; margin-bottom: 6px; color: var(--color-primary-900);">Telephone Hotlines</h4>
                            <div style="font-size: 0.95rem; line-height: 1.6;">
                                <a href="tel:<?= e($phonePrimary) ?>" style="color: var(--color-primary-900); font-weight: 700;"><?= e($phonePrimary) ?></a><br>
                                <a href="tel:<?= e($phoneSecondary) ?>" style="color: var(--color-primary-900); font-weight: 700;"><?= e($phoneSecondary) ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 26px; margin-bottom: 20px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; gap: 14px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div>
                            <h4 style="font-size: 1.05rem; margin-bottom: 6px; color: var(--color-primary-900);">Official Email</h4>
                            <div style="font-size: 0.95rem;">
                                <a href="mailto:<?= e($emailPrimary) ?>" style="color: var(--color-primary-900); font-weight: 600;"><?= e($emailPrimary) ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 26px; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; gap: 14px; align-items: flex-start;">
                        <div style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.12); color: var(--color-accent-600); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div>
                            <h4 style="font-size: 1.05rem; margin-bottom: 6px; color: var(--color-primary-900);">Working Hours</h4>
                            <div style="font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.55;">
                                <?= e($businessHours) ?><br>
                                Sunday: Closed (Emergency Site Response Only)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Submission Form -->
            <div class="form-box">
                <h3 style="font-size: 1.55rem; margin-bottom: 10px; color: var(--color-primary-900);">Send Us a Message</h3>
                <p style="font-size: 0.94rem; color: var(--color-dark-600); margin-bottom: 24px;">
                    Have an upcoming construction project, site inspection request, or tender inquiry? Fill in the details below.
                </p>

                <?php if ($success): ?>
                    <div class="alert alert-success" style="margin-bottom: 24px;">
                        <span>Thank you. Your message has been received by our engineering office. A project director will respond promptly.</span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errorMessage)): ?>
                    <div class="alert alert-danger" style="margin-bottom: 24px;">
                        <span><?= e($errorMessage) ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?= url('contact.php') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Full Name <span class="required">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="Engr. / Mr. / Mrs. Name" value="<?= e($_POST['name'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" required placeholder="your@email.com" value="<?= e($_POST['email'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="0803XXXXXXX" value="<?= e($_POST['phone'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Project / Subject <span class="required">*</span></label>
                            <input type="text" name="subject" class="form-control" required placeholder="e.g. Raft Foundation Construction / School Building" value="<?= e($_POST['subject'] ?? '') ?>">
                        </div>

                        <div class="form-group-full form-group">
                            <label class="form-label">Project Brief / Message <span class="required">*</span></label>
                            <textarea name="message" class="form-control" required style="min-height: 140px;" placeholder="Please outline your project location, scope, site dimensions, or requirements..."><?= e($_POST['message'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 10px;">
                        SEND MESSAGE &rarr;
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Frequently Asked Questions Accordion -->
<?php if (!empty($faqs)): ?>
<section class="section section-gray">
    <div class="container" style="max-width: 900px;">
        <div class="section-header">
            <span class="section-tag">COMMON INQUIRIES</span>
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">
                Clear answers regarding our construction quotations, service coverage, and project turnaround times.
            </p>
        </div>

        <div style="display: flex; flex-direction: column; gap: 16px;">
            <?php foreach ($faqs as $fq): ?>
            <div style="background: var(--color-white); border-radius: var(--radius-md); padding: 24px; border: 1px solid var(--color-gray-200); box-shadow: var(--shadow-sm);">
                <h4 style="font-size: 1.15rem; color: var(--color-primary-900); margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="color: var(--color-accent-500);"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    <span><?= e($fq['question']) ?></span>
                </h4>
                <p style="font-size: 0.94rem; color: var(--color-dark-600); line-height: 1.65; margin-bottom: 0; padding-left: 30px;">
                    <?= e($fq['answer']) ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Map & Geographic Headquarters Location -->
<section style="background: var(--color-white); padding: 50px 0 70px 0;">
    <div class="container">
        <div style="background: var(--color-white); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-md); border: 1px solid var(--color-gray-200);">
            <div style="padding: 24px 30px; border-bottom: 1px solid var(--color-gray-200); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                <div>
                    <h3 style="font-size: 1.25rem; margin-bottom: 4px; color: var(--color-primary-900);">Physical Office Location &bull; Osogbo, Osun State</h3>
                    <p style="font-size: 0.9rem; color: var(--color-dark-600); margin: 0;"><?= e($officeAddress) ?></p>
                </div>
                <a href="https://maps.google.com/?q=No+48+Baruwa+Street+Osogbo+Osun+State+Nigeria" target="_blank" rel="noopener noreferrer" class="btn btn-outline-gold btn-sm">
                    Open in Google Maps &rarr;
                </a>
            </div>
            <div style="width: 100%; height: 420px; position: relative; background: #e2e8f0;">
                <iframe 
                    src="https://maps.google.com/maps?q=Baruwa+Street,+Osogbo,+Osun+State,+Nigeria&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    title="SOLARAC Company LTD Office Location">
                </iframe>
            </div>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
