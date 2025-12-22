// Toggle sidebar untuk mobile
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
const toggleBtn = document.getElementById('sidebar-toggle');
const closeBtn = document.getElementById('sidebar-close');

function openSidebar() {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeSidebar() {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    document.body.style.overflow = '';
}

toggleBtn.addEventListener('click', openSidebar);
closeBtn.addEventListener('click', closeSidebar);
overlay.addEventListener('click', closeSidebar);

// Close sidebar saat window diresize ke desktop
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        closeSidebar();
    }
});

// Toggle profile dropdown
const profileBtn = document.getElementById('profile-dropdown-btn');
const profileDropdown = document.getElementById('profile-dropdown');

profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('hidden');
});

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
    if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
        profileDropdown.classList.add('hidden');
    }
});

// Close dropdown when pressing Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        profileDropdown.classList.add('hidden');
    }
});

// Fetch ionality for searching and pagination
let searchTimeout;
const searchInput = document.getElementById('searchInput');
const tableWrapper = document.getElementById('tableWrapper');
const loadingOverlay = document.getElementById('loadingOverlay');

async function fetchData(url) {
    try {
        if (loadingOverlay) {
            loadingOverlay.classList.remove('hidden');
        }

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const html = await response.text();
        tableWrapper.innerHTML = html;

        attachPaginationListeners();
        window.history.pushState({}, '', url);
    } catch (error) {
        console.error('Error fetching:', error);
        alert('Terjadi kesalahan saat memuat data');
    } finally {
        if (loadingOverlay) {
            loadingOverlay.classList.add('hidden');
        }
    }
}

if (searchInput) {
    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 800);
    });

    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(searchTimeout);
            performSearch();
        }
    });
}

function performSearch() {
    if (!searchInput) return;

    const searchValue = searchInput.value.trim();
    const url = new URL(searchInput.dataset.url, window.location.origin);

    if (searchValue) {
        url.searchParams.set('search', searchValue);
    }

    fetchData(url.toString());
}

function attachPaginationListeners() {
    const paginationLinks = document.querySelectorAll('#paginationContainer a');

    paginationLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.getAttribute('href');
            if (!url || url === '#') return;

            const urlObj = new URL(url, window.location.origin);

            if (searchInput && searchInput.value.trim()) {
                urlObj.searchParams.set('search', searchInput.value.trim());
            }

            fetchData(urlObj.toString());

            tableWrapper?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    attachPaginationListeners();
});

window.addEventListener('popstate', function () {
    location.reload();
});
