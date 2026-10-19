<?php
/**
 * SOLARAC Company LTD - Reusable Quick Request for Quote (RFQ) Modal
 */
?>
<div class="modal-overlay" id="quickRfqModal" role="dialog" aria-modal="true" aria-labelledby="rfqModalTitle">
    <div class="modal-container">
        <div class="modal-header">
            <h3 id="rfqModalTitle">Quick Engineering Project Inquiry / RFQ</h3>
            <button type="button" class="modal-close" data-modal-close aria-label="Close Modal">&times;</button>
        </div>
        <div class="modal-body">
            <form action="<?= url('quote.php') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="is_quick_rfq" value="1">
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name <span class="required">*</span></label>
                        <input type="text" name="customer_name" class="form-control" required placeholder="Your full name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Client / Agency / Firm</label>
                        <input type="text" name="company_name" class="form-control" placeholder="Ministry, corporate or private firm">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control" required placeholder="contact@domain.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number <span class="required">*</span></label>
                        <input type="tel" name="phone" class="form-control" required placeholder="080XXXXXXXX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Engineering Discipline <span class="required">*</span></label>
                        <select name="industry" class="form-control" required>
                            <option value="">Select Engineering Scope</option>
                            <option value="Building Construction">Civil &amp; Building Construction</option>
                            <option value="Raft Foundations">Raft Foundations &amp; Earthworks</option>
                            <option value="Concrete Fencing">Fair-Faced Concrete Fencing</option>
                            <option value="Highways & Drainage">Transport Infrastructure &amp; Highways</option>
                            <option value="Turnkey Project Management">Turnkey Project Management</option>
                            <option value="Facilities & Telecom">General Facilities &amp; Masts</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Project Scope / Title <span class="required">*</span></label>
                        <input type="text" name="service_or_product" class="form-control" required placeholder="e.g. 500m Perimeter Fence, 3-Storey Complex">
                    </div>
                    <div class="form-group-full form-group">
                        <label class="form-label">Quantity &amp; Specifications</label>
                        <input type="text" name="quantity" class="form-control" placeholder="Estimated quantity / size / metrics">
                    </div>
                    <div class="form-group-full form-group">
                        <label class="form-label">Brief Project Description <span class="required">*</span></label>
                        <textarea name="project_description" class="form-control" style="min-height: 90px;" required placeholder="Describe technical specifications, site location, or delivery timelines..."></textarea>
                    </div>
                </div>

                <div style="margin-top: 10px; display: flex; justify-content: space-between; align-items: center;">
                    <a href="<?= url('quote.php') ?>" style="font-size: 0.85rem; color: var(--color-accent-500); font-weight: 600;">
                        Open Detailed Multi-Item RFQ Form &rarr;
                    </a>
                    <button type="submit" class="btn btn-primary">
                        SUBMIT RFQ NOW
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
