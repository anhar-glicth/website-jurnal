/**
 * UI Pro Max Theme — Premium JavaScript
 * Jurnal Pradaya | OJS 3.4
 * 
 * Features:
 * - Dark Mode Toggle with localStorage persistence
 * - Animated Counter Stats (IntersectionObserver)
 * - Reading Progress Bar (scroll-based)
 * - Modal Login/Register (tabbed)
 * - Scroll Reveal Animations
 */

document.addEventListener('DOMContentLoaded', function () {

    // ============================================================
    // 1. DARK MODE TOGGLE
    // ============================================================
    const darkToggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;

    // Load saved preference
    const savedTheme = localStorage.getItem('pm_theme');
    if (savedTheme === 'dark') {
        html.setAttribute('data-theme', 'dark');
    } else if (savedTheme === 'light') {
        html.setAttribute('data-theme', 'light');
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        html.setAttribute('data-theme', 'dark');
    }

    if (darkToggle) {
        darkToggle.addEventListener('click', function () {
            const current = html.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('pm_theme', next);
        });
    }

    // ============================================================
    // 2. ANIMATED COUNTER STATS
    // ============================================================
    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-target'), 10);
        if (isNaN(target)) return;
        const duration = 1800;
        const startTime = performance.now();

        function easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }

        function update(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const value = Math.floor(easeOutCubic(progress) * target);
            el.textContent = value.toLocaleString();
            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                el.textContent = target.toLocaleString();
            }
        }

        requestAnimationFrame(update);
    }

    const counterEls = document.querySelectorAll('.pm_stat_number[data-target]');
    if (counterEls.length > 0) {
        const counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        counterEls.forEach(function (el) {
            el.textContent = '0';
            counterObserver.observe(el);
        });
    }

    // ============================================================
    // 3. READING PROGRESS BAR
    // ============================================================
    const progressBar = document.getElementById('readingProgressBar');
    const isArticlePage = document.body.classList.contains('pkp_page_article') ||
                          document.querySelector('.obj_article_details');

    if (progressBar && isArticlePage) {
        progressBar.style.display = 'block';

        function updateProgress() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            if (docHeight > 0) {
                const percent = (scrollTop / docHeight) * 100;
                progressBar.style.width = percent + '%';
            }
        }

        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();
    }

    // ============================================================
    // 4. MODAL LOGIN/REGISTER
    // ============================================================
    const modalOverlay = document.getElementById('pmModalOverlay');
    const modalIframe = document.getElementById('pmModalIframe');
    const tabLogin = document.getElementById('pmTabLogin');
    const tabRegister = document.getElementById('pmTabRegister');
    const modalClose = document.getElementById('pmModalClose');

    // Get URLs from data attributes
    var loginUrl = '';
    var registerUrl = '';
    if (modalOverlay) {
        loginUrl = modalOverlay.getAttribute('data-login-url') || '';
        registerUrl = modalOverlay.getAttribute('data-register-url') || '';
    }

    function openModal(type) {
        if (!modalOverlay || !modalIframe) return;
        switchTab(type);
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function switchTab(type) {
        if (!modalIframe || !tabLogin || !tabRegister) return;
        if (type === 'login') {
            modalIframe.src = loginUrl;
            tabLogin.classList.add('active');
            tabRegister.classList.remove('active');
        } else {
            modalIframe.src = registerUrl;
            tabRegister.classList.add('active');
            tabLogin.classList.remove('active');
        }
    }

    function closeModal() {
        if (!modalOverlay || !modalIframe) return;
        modalOverlay.classList.remove('active');
        modalIframe.src = 'about:blank';
        document.body.style.overflow = '';
    }

    // Bind triggers
    var triggers = document.querySelectorAll('.pm_trigger_modal');
    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            var type = this.classList.contains('btn_login') ? 'login' : 'register';
            openModal(type);
        });
    });

    // Tab clicks
    if (tabLogin) tabLogin.addEventListener('click', function () { switchTab('login'); });
    if (tabRegister) tabRegister.addEventListener('click', function () { switchTab('register'); });

    // Close
    if (modalClose) modalClose.addEventListener('click', closeModal);
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });
    }

    // ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    // ============================================================
    // 5. SCROLL REVEAL ANIMATIONS
    // ============================================================
    var revealEls = document.querySelectorAll('.pm_reveal');
    if (revealEls.length > 0) {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('pm_visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(function (el) {
            revealObserver.observe(el);
        });
    }

    // ============================================================
    // 6. STAGGERED CARD ENTRANCE (for dynamically loaded content)
    // ============================================================
    var cards = document.querySelectorAll('.obj_article_summary, .pm_stat_card');
    cards.forEach(function (card, i) {
        card.style.animationDelay = (i * 0.08) + 's';
    });

    // ============================================================
    // 7. SMOOTH SCROLL FOR ANCHOR LINKS
    // ============================================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var targetId = this.getAttribute('href');
            if (targetId && targetId.length > 1) {
                var targetEl = document.querySelector(targetId);
                if (targetEl) {
                    e.preventDefault();
                    targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

});
