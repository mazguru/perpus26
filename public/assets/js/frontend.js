function showLoading() {
    document.getElementById('isLoading').style.display = 'flex';
}

function hideLoading() {
    setTimeout(() => {
        document.getElementById('isLoading').style.display = 'none';
    }, 100);
}
function navbar() {
    return {
        openMenu: false,
        scrolled: false,
        currentPage: "home",
        baseUrl: _BASEURL, // Ganti dengan base URL proyek
        init() {
            window.addEventListener('scroll', () => { this.scrolled = window.scrollY > 50 });
        },
        menus: [
            { name: "Home", link: _BASEURL, page: "home" },
            { name: "About", link: _BASEURL + 'about_us', page: "about" },
            {
                name: "Laporan", page: "reports",
                children: [
                    { name: "Presensi Hari Ini", link: _BASEURL + "reports_today", page: "daily" },
                    { name: "Presensi Bulanan", link: _BASEURL + "reports_monthly", page: "monthly" },
                    { name: "Laporan Pelanggaran", link: _BASEURL + "reports/violations", page: "violations" }
                ]
            },
            { name: "Contact", link: _BASEURL + "contact", page: "contact" }
        ],

        toggleMenu() {
            this.openMenu = !this.openMenu;
        },
        setPage(page) {
            this.currentPage = page;
        }
    }
}

function shareOnFacebook() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
}

function shareOnTwitter() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank');
}

function shareOnLinkedIn() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}`, '_blank');
}

function shareOnPinterest() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    const image = encodeURIComponent(document.querySelector('svg').src || '');
    window.open(`https://pinterest.com/pin/create/button/?url=${url}&media=${image}&description=${title}`, '_blank');
}

function shareByEmail() {
    const url = window.location.href;
    const title = document.title;
    window.location.href = `mailto:?subject=${title}&body=Check out this article: ${url}`;
}

function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        const notification = document.getElementById('linkCopied');
        notification.classList.remove('hidden');
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 3000);
    });
}