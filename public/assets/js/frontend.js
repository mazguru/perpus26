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
        init(){
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