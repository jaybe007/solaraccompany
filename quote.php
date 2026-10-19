<?php
/**
 * SOLARAC Company LTD - Request for Quote (RFQ) System
 * RC: 1175907 | Civil Engineering, Building Construction & Project Management
 */
require_once __DIR__ . '/config/config.php';

$pageTitle = "Request a Construction Quote (RFQ) | SOLARAC Company LTD";
$pageDescription = "Submit an official Request for Quotation (RFQ) or Bill of Quantities (BOQ) for civil engineering, building construction, raft foundations, concrete fencing, or project management.";

$successRfq = null;
$errorMessage = '';

// Pre-fill parameters if redirected from product or service page
$prefillItem = trim($_GET['item'] ?? $_GET['service'] ?? '');
$prefillIndustry = trim($_GET['industry'] ?? '');

// Handle RFQ Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::validateOrAbort();

    $customerName   = trim($_POST['customer_name'] ?? '');
    $companyName    = trim($_POST['company_name'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $phone          = trim($_POST['phone'] ?? '');
    $industry       = trim($_POST['industry'] ?? '');
    $itemOrService  = trim($_POST['service_or_product'] ?? '');
    $quantity       = trim($_POST['quantity'] ?? '');
    $location       = trim($_POST['project_location'] ?? '');
    $deliveryDate   = !empty($_POST['required_delivery_date']) ? $_POST['required_delivery_date'] : null;
    $description    = trim($_POST['project_description'] ?? '');
    $notes          = trim($_POST['additional_notes'] ?? '');

    // Validation
    if (empty($customerName) || empty($email) || empty($phone) || empty($industry) || empty($itemOrService) || empty($description)) {
        $errorMessage = "Please complete all mandatory fields marked with an asterisk (*).";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Please enter a valid corporate or personal email address.";
    } else {
        // Handle Attachment File Upload if present
        $attachmentPath = null;
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = Uploader::upload($_FILES['attachment'], 'RFQ Attachment from ' . $customerName);
            if ($uploadResult['success']) {
                $attachmentPath = $uploadResult['file_path'];
            } else {
                $errorMessage = "Attachment error: " . $uploadResult['error'];
            }
        }

        if (empty($errorMessage)) {
            try {
                // Generate Unique Sequential RFQ Number (e.g. RFQ-2026-000001)
                $year = date('Y');
                $countThisYear = (int)Database::fetchColumn(
                    "SELECT COUNT(*) FROM `rfqs` WHERE `rfq_number` LIKE :prefix",
                    [':prefix' => "RFQ-{$year}-%"]
                );
                $nextSeq = str_pad((string)($countThisYear + 1), 6, '0', STR_PAD_LEFT);
                $rfqNumber = "RFQ-{$year}-{$nextSeq}";

                $rfqId = Database::insert('rfqs', [
                    'rfq_number'            => $rfqNumber,
                    'customer_name'         => $customerName,
                    'company_name'          => $companyName ?: null,
                    'email'                 => $email,
                    'phone'                 => $phone,
                    'industry'              => $industry,
                    'service_or_product'    => $itemOrService,
                    'quantity'              => $quantity ?: null,
                    'project_location'      => $location ?: null,
                    'required_delivery_date'=> $deliveryDate,
                    'project_description'   => $description,
                    'attachment_path'       => $attachmentPath,
                    'additional_notes'      => $notes ?: null,
                    'status'                => 'NEW',
                    'ip_address'            => $_SERVER['REMOTE_ADDR'] ?? null,
                    'created_at'            => date('Y-m-d H:i:s')
                ]);

                // Insert into rfq_items table for normalized line-item tracking
                try {
                    Database::insert('rfq_items', [
                        'rfq_id'         => $rfqId,
                        'item_name'      => $itemOrService,
                        'specifications' => truncate($description, 200),
                        'quantity'       => $quantity ?: '1 Lot',
                        'unit'           => 'Specified Scope'
                    ]);
                } catch (Exception $e) {
                    error_log("rfq_items notice: " . $e->getMessage());
                }

                // Record Audit Log
                Audit::log('submit_rfq', 'rfqs', (string)$rfqId, "New RFQ {$rfqNumber} submitted by {$customerName} ({$email})");

                // Prepare array for emails
                $rfqData = [
                    'id'                    => $rfqId,
                    'rfq_number'            => $rfqNumber,
                    'customer_name'         => $customerName,
                    'company_name'          => $companyName,
                    'email'                 => $email,
                    'phone'                 => $phone,
                    'industry'              => $industry,
                    'service_or_product'    => $itemOrService,
                    'quantity'              => $quantity,
                    'project_location'      => $location,
                    'required_delivery_date'=> $deliveryDate,
                    'project_description'   => $description,
                    'additional_notes'      => $notes,
                    'created_at'            => date('Y-m-d H:i:s')
                ];

                // Attempt sending email confirmations safely
                try {
                    Mailer::sendRfqCustomerConfirmation($rfqData);
                    Mailer::sendRfqAdminNotification($rfqData);
                } catch (Exception $e) {
                    error_log("RFQ mailer notice: " . $e->getMessage());
                }

                $successRfq = $rfqData;
            } catch (Exception $e) {
                error_log("RFQ submission error: " . $e->getMessage());
                $errorMessage = "Unable to register RFQ due to a database exception. Please call our engineering office directly at 08035188495.";
            }
        }
    }
}

include INCLUDES_PATH . 'header.php';
?>

<div class="section-dark" style="padding: 70px 0; border-bottom: 3px solid var(--color-accent-500); background: linear-gradient(135deg, #071221 0%, #0c203b 100%);">
    <div class="container">
        <span class="section-tag section-tag-light">COMMERCIAL TENDER &amp; ESTIMATION</span>
        <h1 style="font-size: 2.85rem; color: #fff; margin-bottom: 14px;">Request a Project Quote (RFQ)</h1>
        <p style="color: #cbd5e1; max-width: 780px; font-size: 1.12rem; margin-bottom: 0; line-height: 1.65;">
            Submit your Bill of Quantities (BOQ), architectural drawings, or civil construction specifications for prompt technical review and cost estimation.
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if ($successRfq): ?>
            <!-- Success Confirmation Screen -->
            <div style="background: var(--color-white); border: 2px solid var(--color-success); border-radius: var(--radius-lg); padding: 50px 30px; text-align: center; max-width: 720px; margin: 0 auto; box-shadow: var(--shadow-xl);">
                <div style="width: 76px; height: 76px; border-radius: 50%; background: #d1fae5; color: var(--color-success); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto;">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                </div>

                <span class="section-tag" style="background: #d1fae5; color: #065f46;">SUBMISSION SUCCESSFUL</span>
                <h2 style="font-size: 2.2rem; margin: 12px 0; color: var(--color-primary-900);">Construction RFQ Received</h2>
                <p style="font-size: 1.05rem; color: var(--color-dark-600); max-width: 600px; margin: 0 auto 24px auto;">
                    Thank you, <strong><?= e($successRfq['customer_name']) ?></strong>. Your project estimation inquiry has been logged into our engineering review pipeline.
                </p>

                <div style="background: var(--color-gray-100); border: 1.5px dashed var(--color-accent-500); border-radius: var(--radius-md); padding: 24px; max-width: 500px; margin: 0 auto 30px auto; text-align: left;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span style="color: var(--color-dark-600); font-weight: 600;">Tracking Number:</span>
                        <strong style="color: var(--color-accent-600); font-size: 1.15rem;"><?= e($successRfq['rfq_number']) ?></strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span style="color: var(--color-dark-600); font-weight: 600;">Project / Service:</span>
                        <span><?= e($successRfq['service_or_product']) ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--color-dark-600); font-weight: 600;">Status:</span>
                        <span class="badge-status badge-new">NEW / UNDER REVIEW</span>
                    </div>
                </div>

                <p style="font-size: 0.92rem; color: var(--color-dark-600); margin-bottom: 30px;">
                    An official email acknowledgment has been dispatched to <strong><?= e($successRfq['email']) ?></strong>. Our structural estimators will contact you within 24 to 48 business hours.
                </p>

                <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
                    <a href="<?= url('track.php?rfq=' . urlencode($successRfq['rfq_number'])) ?>" class="btn btn-primary">
                        Track RFQ Status &rarr;
                    </a>
                    <a href="<?= url('') ?>" class="btn btn-navy">Return to Home</a>
                    <a href="<?= url('quote.php') ?>" class="btn btn-outline-gold">Submit Another RFQ</a>
                </div>
            </div>
        <?php else: ?>
            <!-- RFQ Input Form -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 48px; align-items: start;">
                <div class="form-box">
                    <?php if (!empty($errorMessage)): ?>
                        <div class="alert alert-danger" style="margin-bottom: 24px;">
                            <span><?= e($errorMessage) ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="<?= url('quote.php') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <h3 style="font-size: 1.35rem; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid var(--color-gray-200); color: var(--color-primary-900);">
                            1. Client &amp; Organization Details
                        </h3>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Full Name <span class="required">*</span></label>
                                <input type="text" name="customer_name" class="form-control" required placeholder="e.g. Engr. / Alhaji / Dr. Name" value="<?= e($_POST['customer_name'] ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Company / Ministry / Entity</label>
                                <input type="text" name="company_name" class="form-control" placeholder="e.g. State Ministry of Works / Estate Consortium" value="<?= e($_POST['company_name'] ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Corporate Email Address <span class="required">*</span></label>
                                <input type="email" name="email" class="form-control" required placeholder="procurement@organization.com" value="<?= e($_POST['email'] ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phone Number <span class="required">*</span></label>
                                <input type="tel" name="phone" class="form-control" required placeholder="e.g. 08035188495" value="<?= e($_POST['phone'] ?? '') ?>">
                            </div>
                        </div>

                        <h3 style="font-size: 1.35rem; margin: 30px 0 20px 0; padding-bottom: 10px; border-bottom: 1px solid var(--color-gray-200); color: var(--color-primary-900);">
                            2. Construction Scope &amp; Site Details
                        </h3>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Engineering Discipline <span class="required">*</span></label>
                                <select name="industry" class="form-control" required>
                                    <option value="">Select Engineering Discipline</option>
                                    <option value="Civil & Building Construction" <?= ($prefillIndustry === 'Civil & Building Construction' || ($_POST['industry'] ?? '') === 'Civil & Building Construction') ? 'selected' : '' ?>>Civil &amp; Building Construction</option>
                                    <option value="Project Management & EPC" <?= ($prefillIndustry === 'Project Management & EPC' || ($_POST['industry'] ?? '') === 'Project Management & EPC') ? 'selected' : '' ?>>Turnkey Project Management &amp; EPC</option>
                                    <option value="Foundation & Raft Engineering" <?= ($prefillIndustry === 'Foundation & Raft Engineering' || ($_POST['industry'] ?? '') === 'Foundation & Raft Engineering') ? 'selected' : '' ?>>Foundation &amp; Raft Engineering</option>
                                    <option value="Reinforced Concrete Fencing" <?= ($prefillIndustry === 'Reinforced Concrete Fencing' || ($_POST['industry'] ?? '') === 'Reinforced Concrete Fencing') ? 'selected' : '' ?>>Reinforced Concrete Perimeter Fencing</option>
                                    <option value="Transportation & Highways" <?= ($prefillIndustry === 'Transportation & Highways' || ($_POST['industry'] ?? '') === 'Transportation & Highways') ? 'selected' : '' ?>>Transportation, Roads &amp; Drainage</option>
                                    <option value="Facilities & Telecom Infrastructure" <?= ($prefillIndustry === 'Facilities & Telecom Infrastructure' || ($_POST['industry'] ?? '') === 'Facilities & Telecom Infrastructure') ? 'selected' : '' ?>>Facilities Management &amp; Telecom Masts</option>
                                    <option value="General Contracting" <?= ($prefillIndustry === 'General Contracting' || ($_POST['industry'] ?? '') === 'General Contracting') ? 'selected' : '' ?>>General Contracting &amp; Supplies</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Project Title / Scope Name <span class="required">*</span></label>
                                <input type="text" name="service_or_product" class="form-control" required placeholder="e.g. 40-Unit Raft Foundation Construction" value="<?= e($prefillItem ?: ($_POST['service_or_product'] ?? '')) ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Estimated Scale / Dimensions</label>
                                <input type="text" name="quantity" class="form-control" placeholder="e.g. 300 Meters / 3-Story Block / 1500 sqm" value="<?= e($_POST['quantity'] ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Site / Delivery Location</label>
                                <input type="text" name="project_location" class="form-control" placeholder="e.g. Osogbo, Osun State or Lekki, Lagos" value="<?= e($_POST['project_location'] ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Target Commencement Date</label>
                                <input type="date" name="required_delivery_date" class="form-control" value="<?= e($_POST['required_delivery_date'] ?? '') ?>">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Upload Drawings / Bill of Quantities (BOQ)</label>
                                <input type="file" name="attachment" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.webp,.dwg,.zip">
                                <span class="form-help">PDF, DWG, ZIP, JPG or PNG up to 15MB</span>
                            </div>

                            <div class="form-group-full form-group">
                                <label class="form-label">Detailed Project Specifications <span class="required">*</span></label>
                                <textarea name="project_description" class="form-control" required style="min-height: 140px;" placeholder="Describe the structural requirements, soil conditions, materials, or architectural guidelines..."><?= e($_POST['project_description'] ?? '') ?></textarea>
                            </div>

                            <div class="form-group-full form-group">
                                <label class="form-label">Commercial Guidelines / Tender Terms</label>
                                <textarea name="additional_notes" class="form-control" style="min-height: 80px;" placeholder="Milestones, payment structures, mobilization dates, or specific questions..."><?= e($_POST['additional_notes'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <div style="margin-top: 24px;">
                            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                                TRANSMIT PROJECT RFQ &rarr;
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Guidance & Hotlines Sidebar -->
                <div>
                    <div style="background: var(--color-white); border: 1px solid var(--color-gray-200); border-radius: var(--radius-md); padding: 30px; box-shadow: var(--shadow-sm); margin-bottom: 24px;">
                        <h4 style="font-size: 1.15rem; margin-bottom: 14px; color: var(--color-primary-900);">Our Tendering Protocol</h4>
                        <ol style="list-style: decimal; padding-left: 18px; font-size: 0.9rem; color: var(--color-dark-600); line-height: 1.7;">
                            <li style="margin-bottom: 10px;"><strong>Submission:</strong> Submit your BOQ, architectural specs, or site brief.</li>
                            <li style="margin-bottom: 10px;"><strong>Tracking Assignment:</strong> A unique tracking ID (e.g. <code>RFQ-2026-000001</code>) is automatically generated.</li>
                            <li style="margin-bottom: 10px;"><strong>Engineering Review:</strong> Our structural engineers assess soil data, rebar schedules, and material logistics.</li>
                            <li><strong>Formal Proposal:</strong> A competitive commercial quote with CPM milestone timelines is issued.</li>
                        </ol>
                    </div>

                    <div style="background: var(--color-primary-900); color: #fff; border-radius: var(--radius-md); padding: 30px;">
                        <h4 style="color: #fff; font-size: 1.15rem; margin-bottom: 12px;">Urgent Site Requirement?</h4>
                        <p style="color: #cbd5e1; font-size: 0.88rem; margin-bottom: 20px; line-height: 1.55;">
                            For immediate mobilization or site inspection inquiries, reach our engineering desk directly:
                        </p>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <a href="tel:08035188495" class="btn btn-outline-gold btn-sm" style="width: 100%;">
                                Call: 08035188495
                            </a>
                            <a href="tel:08065833345" class="btn btn-outline-light btn-sm" style="width: 100%;">
                                Call: 08065833345
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer.php'; ?>
