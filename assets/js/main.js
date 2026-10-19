/**
 * STONE ENERGY INT'L LTD - Frontend Vanilla JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
  // 1. Mobile Menu Navigation Toggle
  const mobileToggle = document.getElementById('mobileNavToggle');
  const navMenu = document.getElementById('navMenu');

  function closeMobileNav() {
    if (navMenu) navMenu.classList.remove('open');
    if (mobileToggle) {
      mobileToggle.setAttribute('aria-expanded', 'false');
      mobileToggle.classList.remove('active');
    }
    document.body.classList.remove('mobile-nav-open');
  }

  function openMobileNav() {
    if (navMenu) navMenu.classList.add('open');
    if (mobileToggle) {
      mobileToggle.setAttribute('aria-expanded', 'true');
      mobileToggle.classList.add('active');
    }
    document.body.classList.add('mobile-nav-open');
  }

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      if (navMenu.classList.contains('open')) {
        closeMobileNav();
      } else {
        openMobileNav();
      }
    });

    // Close on link click
    navMenu.querySelectorAll('.nav-link, .mobile-only-cta a').forEach(link => {
      link.addEventListener('click', () => {
        closeMobileNav();
      });
    });

    // Close on click outside
    document.addEventListener('click', function (e) {
      if (navMenu.classList.contains('open') && !navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
        closeMobileNav();
      }
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && navMenu.classList.contains('open')) {
        closeMobileNav();
      }
    });
  }

  // 2. Global Modal Window Management
  const modalTriggers = document.querySelectorAll('[data-modal-target]');
  const modalClosers = document.querySelectorAll('[data-modal-close]');
  const modalOverlays = document.querySelectorAll('.modal-overlay');

  modalTriggers.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('data-modal-target');
      const modal = document.getElementById(targetId);
      if (modal) {
        // Pre-fill subject or requirement if specified on button
        const itemVal = this.getAttribute('data-quote-item');
        if (itemVal) {
          const itemInput = modal.querySelector('input[name="service_or_product"]');
          if (itemInput) itemInput.value = itemVal;
        }
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  function closeModal(modal) {
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  modalClosers.forEach(btn => {
    btn.addEventListener('click', function () {
      const modal = this.closest('.modal-overlay');
      closeModal(modal);
    });
  });

  modalOverlays.forEach(overlay => {
    overlay.addEventListener('click', function (e) {
      if (e.target === this) {
        closeModal(this);
      }
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      modalOverlays.forEach(closeModal);
    }
  });

  // 3. Dynamic Category Filtering (Products & Projects)
  const filterButtons = document.querySelectorAll('.pill-btn[data-filter]');
  if (filterButtons.length > 0) {
    filterButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        filterButtons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filterVal = this.getAttribute('data-filter');
        const items = document.querySelectorAll('.filterable-item');

        items.forEach(item => {
          const itemCat = item.getAttribute('data-category');
          if (filterVal === 'all' || itemCat === filterVal) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // 4. Toast Notification Utility
  window.showToast = function (message, type = 'info') {
    let container = document.getElementById('toastContainer');
    if (!container) {
      container = document.createElement('div');
      container.id = 'toastContainer';
      container.className = 'toast-container';
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `<span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100%)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 4500);
  };

  // 5. Hero Background Slideshow
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-slider-dot');
  if (slides.length > 1) {
    let currentSlide = 0;
    let slideTimer = null;

    function goToSlide(idx) {
      slides[currentSlide].classList.remove('active');
      if (dots[currentSlide]) dots[currentSlide].classList.remove('active');
      currentSlide = (idx + slides.length) % slides.length;
      slides[currentSlide].classList.add('active');
      if (dots[currentSlide]) dots[currentSlide].classList.add('active');
    }

    function startAutoSlide() {
      slideTimer = setInterval(() => {
        goToSlide(currentSlide + 1);
      }, 5500);
    }

    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => {
        clearInterval(slideTimer);
        goToSlide(idx);
        startAutoSlide();
      });
    });

    startAutoSlide();
  }

  // 6. Image Lightbox Modal
  const lightboxModal = document.getElementById('globalLightboxModal');
  const lightboxImg = document.getElementById('lightboxModalImg');
  const lightboxTitle = document.getElementById('lightboxModalTitle');
  const lightboxTriggers = document.querySelectorAll('[data-lightbox-img]');

  if (lightboxModal && lightboxImg) {
    lightboxTriggers.forEach(el => {
      el.addEventListener('click', function(e) {
        e.preventDefault();
        const src = this.getAttribute('data-lightbox-img');
        const title = this.getAttribute('data-lightbox-title') || 'Image Preview';
        lightboxImg.src = src;
        if (lightboxTitle) lightboxTitle.textContent = title;
        lightboxModal.classList.add('active');
        document.body.style.overflow = 'hidden';
      });
    });

    const closeBtn = lightboxModal.querySelector('.lightbox-close-btn');
    if (closeBtn) {
      closeBtn.addEventListener('click', () => {
        lightboxModal.classList.remove('active');
        document.body.style.overflow = '';
      });
    }

    lightboxModal.addEventListener('click', function(e) {
      if (e.target === this) {
        this.classList.remove('active');
        document.body.style.overflow = '';
      }
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && lightboxModal.classList.contains('active')) {
        lightboxModal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  }

  // 7. General Filterable Items
  const filterBtns = document.querySelectorAll('.filter-btn[data-filter]');
  if (filterBtns.length > 0) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.getAttribute('data-filter');
        const items = document.querySelectorAll('.filter-item');
        items.forEach(item => {
          const cat = item.getAttribute('data-category');
          if (filter === 'all' || cat === filter) {
            item.style.display = '';
            item.style.animation = 'fadeIn 0.35s ease-in-out';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }
});

