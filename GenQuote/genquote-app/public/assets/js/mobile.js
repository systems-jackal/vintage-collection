// Mobile enhancements for GenQuote
(function() {
    // Only apply on screens smaller than 768px
    if (window.innerWidth > 768) return;

    // 1. Hamburger menu
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    if (menuToggle && navLinks) {
        navLinks.style.display = 'none';
        menuToggle.addEventListener('click', function() {
            const isVisible = navLinks.style.display === 'flex';
            navLinks.style.display = isVisible ? 'none' : 'flex';
        });
    }

    // 2. Sticky save button (only on quotation create page)
    const saveBtn = document.querySelector('#quotationForm button[type="submit"]');
    const form = document.getElementById('quotationForm');
    if (saveBtn && form) {
        const stickyDiv = document.createElement('div');
        stickyDiv.className = 'sticky-save';
        stickyDiv.innerHTML = '<button type="submit" class="btn" style="width:100%;">💾 Save & Generate PDF</button>';
        document.body.appendChild(stickyDiv);
        // Hide original save button, keep only the sticky one
        saveBtn.style.display = 'none';
        stickyDiv.querySelector('button').addEventListener('click', function(e) {
            e.preventDefault();
            form.submit();
        });
        // Adjust on scroll
        window.addEventListener('scroll', function() {
            const rect = form.getBoundingClientRect();
            if (rect.bottom < 0) {
                stickyDiv.style.display = 'block';
            } else {
                stickyDiv.style.display = 'none';
            }
        });
    }

    // 3. Auto-resize textareas (all)
    document.querySelectorAll('textarea').forEach(ta => {
        ta.style.height = 'auto';
        ta.style.height = ta.scrollHeight + 'px';
        ta.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // 4. Horizontal scroll hint on items table (if overflow)
    const itemsTable = document.querySelector('.dynamic-table');
    if (itemsTable && itemsTable.scrollWidth > itemsTable.clientWidth) {
        const hint = document.createElement('div');
        hint.className = 'scroll-hint';
        hint.innerHTML = '← swipe to see more columns →';
        itemsTable.parentNode.insertBefore(hint, itemsTable);
        setTimeout(() => hint.remove(), 3000);
    }

    // 5. Tap‑to‑copy quotation number (on PDF preview page)
    const refSpan = document.querySelector('.ref-number');
    if (refSpan) {
        refSpan.style.cursor = 'pointer';
        refSpan.addEventListener('click', () => {
            navigator.clipboard.writeText(refSpan.innerText);
            alert('Quotation number copied');
        });
    }
})();