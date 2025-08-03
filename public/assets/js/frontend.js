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
            this.loadReplies(); // dipisah agar lebih aman
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
            const res = await fetch(`/comment/list/${this.postId}?page=${this.page}`);
            const data = await res.json();
            this.comments.push(...data.comments);
            this.hasMore = data.more;
            this.page++;
            console.log(data);
        },

        async loadReplies() {
            const res = await fetch(`/comment/replies/${this.postId}`);
            const data = await res.json();
            this.replies = {}; // inisialisasi ulang
            console.log(data);
            data.replies.forEach(reply => {
                if (!this.replies[reply.comment_parent_id]) {
                    this.replies[reply.comment_parent_id] = [];
                }
                this.replies[reply.comment_parent_id].push(reply);
            });
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

            if (!this.form.name.trim()) {
                this.formErrors.name = true;
                valid = false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.form.email)) {
                this.formErrors.email = true;
                valid = false;
            }

            if (!this.form.content.trim()) {
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
                    comment_author: this.form.name,
                    comment_email: this.form.email,
                    comment_content: this.form.content
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {

                        Notifier.show('komentar', 'Komentar berhasil dikirim', 'success');
                        this.form = {};
                        this.page = 1;
                        this.loadComments();
                        this.loadReplies();
                    } else {
                        alert(data.message || "Gagal mengirim komentar");
                    }
                });
        },

        toggleReplyForm(commentId) {
            this.activeReply = this.activeReply === commentId ? null : commentId;
            this.replyText = '';
        },

        async submitReply(parentId) {
            const payload = {
                comment_post_id: this.postId,
                comment_content: this.replyText,
                comment_author: this.replyName,
                comment_email: this.replyEmail,
                comment_parent_id: parentId,
            };

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
                this.activeReply = null;
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