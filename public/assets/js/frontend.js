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
function addReaction(emoji) {
    const input = document.getElementById('comment-input');
    input.value += ` ${emoji}`;
    input.focus();
}
function timeAgo(datetime) {
    const now = new Date();
    const past = new Date(datetime.replace(' ', 'T')); // ISO-compatible
    const seconds = Math.floor((now - past) / 1000);

    const intervals = [
        { label: 'tahun', seconds: 31536000 },
        { label: 'bulan', seconds: 2592000 },
        { label: 'hari', seconds: 86400 },
        { label: 'jam', seconds: 3600 },
        { label: 'menit', seconds: 60 },
        { label: 'detik', seconds: 1 }
    ];

    for (const interval of intervals) {
        const count = Math.floor(seconds / interval.seconds);
        if (count > 0) {
            return `${count} ${interval.label}${count > 1 ? '' : ''} yang lalu`;
        }
    }

    return 'baru saja';
}
function commentSection(config) {
    return {
        comments: [],
        replies: {},
        form: {
            name: '',
            email: '',
            content: ''
        },
        postId: config.postid,
        page: 1,
        hasMore: false,
        activeReply: null,
        replyName: '',
        replyText: '',
        replyEmail: '',
        formErrors: {
            name: false,
            email: false,
            content: false
        },

        init() {
            this.loadComments();
            this.loadReplies();
        },

        formatDate(dateString) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            return new Date(dateString).toLocaleDateString(undefined, options);
        },

        async loadComments() {
            try {
                const res = await fetch(`/comment/list/${this.postId}?page=${this.page}`);
                const data = await res.json();
                console.log(data);
                if (Array.isArray(data.comments)) {
                    this.comments.push(...data.comments);
                    this.hasMore = data.more || false;
                    this.page++;
                }
            } catch (e) {
                console.error('Gagal memuat komentar:', e);
            }
        },

        async loadReplies() {
            try {
                const res = await fetch(`/comment/replies/${this.postId}`);
                const data = await res.json();
                this.replies = {};
                (data.replies || []).forEach(reply => {
                    if (!this.replies[reply.comment_parent_id]) {
                        this.replies[reply.comment_parent_id] = [];
                    }
                    this.replies[reply.comment_parent_id].push(reply);
                });
            } catch (e) {
                console.error('Gagal memuat balasan:', e);
            }
        },

        loadMore() {
            this.loadComments();
        },

        submitComment() {
            this.formErrors = {
                name: false,
                email: false,
                content: false
            };

            let valid = true;

            if (!this.form.name?.trim()) {
                this.formErrors.name = true;
                valid = false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.form.email || '')) {
                this.formErrors.email = true;
                valid = false;
            }

            if (!this.form.content?.trim()) {
                this.formErrors.content = true;
                valid = false;
            }

            if (!valid) return;

            fetch(`/comment/save`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    comment_post_id: this.postId,
                    comment_author: this.form.name.trim(),
                    comment_email: this.form.email.trim(),
                    comment_content: this.form.content.trim()
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Notifier.show('komentar', 'Komentar berhasil dikirim', 'success');
                        this.form = { name: '', email: '', content: '' };
                        this.page = 1;
                        this.comments = [];
                        this.loadComments();
                        this.loadReplies();
                    } else {
                        Notifier.show(data.message || "Gagal mengirim komentar");
                    }
                })
                .catch(error => {
                    console.error('Error saat kirim komentar:', error);
                });
        },

        toggleReplyForm(commentId) {
            this.activeReply = this.activeReply === commentId ? null : commentId;
            this.replyText = '';
            this.replyName = '';
            this.replyEmail = '';
        },

        async submitReply(parentId) {
            if (!this.replyText.trim() || !this.replyName.trim() || !this.replyEmail.trim()) {
                Notifier.show("Semua kolom balasan harus diisi!");
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.replyEmail)) {
                Notifier.show("Format email tidak valid!");
                return;
            }

            const payload = {
                comment_post_id: this.postId,
                comment_content: this.replyText.trim(),
                comment_author: this.replyName.trim(),
                comment_email: this.replyEmail.trim(),
                comment_parent_id: parentId,
            };

            try {
                const res = await fetch('/comment/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await res.json();
                if (result.status === 'success') {
                    this.loadReplies();
                    this.replyText = '';
                    this.replyName = '';
                    this.replyEmail = '';
                    this.activeReply = null;
                    Notifier.show('balasan', 'Balasan berhasil dikirim', 'success');
                } else {
                    Notifier.show(result.message || "Gagal mengirim balasan");
                }
            } catch (error) {
                console.error('Error saat kirim balasan:', error);
            }
        }
    }
}

function formMessage() {
    return {
        form: {},
        formErrors: {},
        successMessage: '',
        formVisible: true,
        submitComment() {
            this.formErrors = {};
            fetch(`/comment/sendmessage`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(this.form)
            })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 'success') {
                        this.successMessage = "Terima kasih, komentar Anda telah dikirim dan sedang menunggu persetujuan.";
                        this.formVisible = false;
                        Notifier.show('komentar', 'Komentar berhasil dikirim', 'success');
                        this.form = {};
                    } else {
                        Notifier.show('Gagal', data.message || "Gagal mengirim komentar", 'error');
                        this.formErrors = data.errors
                    }
                });
        },
    }
}
function videoSwiper() {
    return {
        swiper: null,
        showModal: false,
        videoUrl: '',
        initSwiper() {
            this.$nextTick(() => {
                const totalSlides = document.querySelectorAll('.video-swiper .swiper-slide').length;
                this.swiper = new Swiper('.video-swiper', {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    loop: totalSlides > 4,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        },
        openModal(code) {
            this.videoUrl = `https://www.youtube.com/embed/${code}?autoplay=1`;
            this.showModal = true;
        },
        closeModal() {
            this.videoUrl = '';
            this.showModal = false;
        }
    };
}

function galleryApp() {
    return {
        showModal: false,
        currentPhotos: [],
        swiper: null,
        open(albumId) {
            const photoContainer = document.getElementById('album-' + albumId);
            if (photoContainer) {
                this.currentPhotos = JSON.parse(photoContainer.textContent);
                if (!this.currentPhotos || this.currentPhotos.length === 0) {
                    Notifier.show('upsss', 'Tidak ada foto dalam album ini', 'error');
                    return;
                }

                this.$nextTick(() => {
                    this.showModal = true;
                    if (this.swiper) this.swiper.destroy(true, true);

                    this.swiper = new Swiper(this.$refs.swiperContainer, {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        centeredSlides: true,
                        autoplay: {
                            delay: 2500,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                });
            }
        },
        close() {
            if (this.swiper) {
                this.swiper.destroy(true, true);
                this.swiper = null;
            }
            this.showModal = false;
        },
        init() {
            // Optional preload
        }
    };
}

function menuPublic() {
    return {
        menus: [],
        openmenu: false,
        currentPath: window.location.pathname,
        base_url: _BASEURL,
        async fetchMenu() {
            try {
                const res = await fetch(this.base_url + 'menupublic', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                const data = await res.json();

                this.menus = data.map(menu => {
                    const fullPath = this.base_url.replace(location.origin, '') + menu.menu_url;
                    let menuActive = this.currentPath === fullPath;

                    const children = (menu.children || []).map(child => {
                        const childPath = this.base_url.replace(location.origin, '') + child.menu_url;
                        const childActive = this.currentPath === childPath;
                        if (childActive) menuActive = true;

                        return {
                            ...child,
                            active: childActive
                        };
                    });

                    return {
                        ...menu,
                        active: menuActive,
                        children
                    };
                });

            } catch (error) {
                console.error('Gagal memuat menu:', error);
            }
        }
    };
}

function visitSummary() {
    return {
        today: 0,
        month: 0,
        year: 0,
        total: 0,
        loadSummary() {
            fetch(_BASEURL + 'visitor/summary')
                .then(res => res.json())
                .then(data => {
                    this.today = data.today;
                    this.month = data.month;
                    this.year = data.year;
                    this.total = data.total;
                });
        }
    }
}