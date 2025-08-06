<?php

use App\Models\AlbumModel;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
use App\Models\LinkModel;
use App\Models\TagsModel;
use App\Models\BannersModel;
use App\Models\QuotesModel;
use App\Models\ImageSlidersModel;
use App\Models\QuestionsModel;
use App\Models\AnswersModel;
use App\Models\PostCommentsModel;
use App\Models\VideosModel;
use App\Models\AlbumsModel;
use App\Models\BannerModel;
use App\Models\MenuModel;
use App\Models\CategoriesModel;
use App\Models\CommentModel;
use App\Models\MenusModel;
use App\Models\PhotoModel;
use App\Models\PostsModel;
use App\Models\publik\PostsModel as PublikPostModel;

// Pastikan helper URL dipakai untuk base_url() & url_title()
helper(['url']);

// =========================
// Session & Tema
// =========================
if (! function_exists('theme_folder')) {
    function theme_folder()
    {
        return session()->get('theme');
    }
}

// =========================
// Links
// =========================
if (! function_exists('get_links')) {
    function get_links(int $limit = 0)
    {
        // Sesuaikan class model Anda
        $m = new LinkModel(); // contoh: model(\App\Models\MLinks::class)
        return $m->where('is_deleted', 'false')->findAll($limit);
    }
}

// =========================
// Tags
// =========================
if (! function_exists('get_tags')) {
    function get_tags(int $limit = 0)
    {
        $m = new TagsModel();
        // TRUE di CI3 untuk include_count (misal). Sesuaikan dengan model CI4 Anda.
        return $m->where('is_deleted', 'false')->findAll($limit);
    }
}

// =========================
// Banners
// =========================
if (! function_exists('get_banners')) {
    function get_banners(int $limit = 0)
    {
        $m = new BannerModel();
        return $m->where('is_deleted', 'false')->findAll($limit);
    }
}

// =========================
// Arsip Tahun & Arsip per Tahun
// =========================
if (! function_exists('get_years')) {
    function get_years()
    {
        $m = new PublikPostModel (); // contoh: \App\Models\Publics\M_posts::class
        return $m->get_years();
    }
}

if (! function_exists('get_archives')) {
    function get_archives(int $year)
    {
        $m = new PublikPostModel ();
        return $m->get_archives($year);
    }
}

// =========================
// Quotes
// =========================
if (! function_exists('get_quotes')) {
    function get_quotes(int $limit = 0)
    {
        $m = model('M_quotes');
        return $m->get_quotes($limit);
    }
}

// =========================
// Image Sliders
// =========================
if (! function_exists('get_image_sliders')) {
    function get_image_sliders(int $limit = 0)
    {
        $m = model('M_image_sliders');
        return $m->get_image_sliders($limit);
    }
}

// =========================
// Polling / Questions & Answers
// =========================
if (! function_exists('get_active_question')) {
    function get_active_question()
    {
        $m = model('M_questions');
        return $m->get_active_question();
    }
}

if (! function_exists('get_answers')) {
    function get_answers(int $question_id)
    {
        $m = model('M_answers');
        return $m->get_answers($question_id);
    }
}

// =========================
// Posts (latest, popular, most_commented, random)
// =========================
if (! function_exists('get_latest_posts')) {
    function get_latest_posts(int $limit = 0)
    {
        $m = new PublikPostModel ();
        return $m->get_latest_posts($limit);
    }
}

if (! function_exists('get_popular_posts')) {
    function get_popular_posts(int $limit = 0)
    {
        $m = new PublikPostModel ();
        return $m->get_popular_posts($limit);
    }
}

if (! function_exists('get_most_commented')) {
    function get_most_commented(int $limit = 0)
    {
        $m = new PublikPostModel ();
        return $m->get_most_commented($limit);
    }
}

if (! function_exists('get_random_posts')) {
    function get_random_posts(int $limit = 0)
    {
        $m = new PublikPostModel ();
        return $m->get_random_posts($limit);
    }
}

// =========================
// Post by Category
// =========================
if (! function_exists('get_post_categories')) {
    function get_post_categories(string $category_slug, int $limit = 0)
    {
        $m = new PublikPostModel ();
        return $m->get_post_categories($category_slug, $limit);
    }
}

// =========================
// Categories
// =========================
if (! function_exists('get_categories')) {
    function get_categories(string $category_type, int $limit = 0)
    {
        $m = model('M_categories');
        return $m->get_categories($category_type, $limit);
    }
}
if (! function_exists('count_post_categories')) {
    function count_post_categories()
    {
        $m = new PublikPostModel();
        return $m->countPostsPerCategory();
    }
}

// =========================
// Related & Another Pages
// =========================
if (! function_exists('get_related_posts')) {
    function get_related_posts(string $categories, int $id)
    {
        $m = new PublikPostModel ();
        return $m->get_related_posts($categories, $id);
    }
}

if (! function_exists('get_another_pages')) {
    function get_another_pages(int $id, int $limit = 0)
    {
        $m = new PublikPostModel ();
        return $m->get_another_pages($id, $limit);
    }
}

// =========================
// Recent Comments
// =========================
if (! function_exists('get_recent_comments')) {
    function get_recent_comments(int $limit = 0)
    {
        $m = new CommentModel();
        return $m->get_recent_comments($limit);
    }
}

// =========================
// Opening Speech (Sambutan)
// =========================
if (! function_exists('get_opening_speech')) {
    function get_opening_speech()
    {
        $m = new PublikPostModel ();
        return $m->get_opening_speech();
    }
}

// =========================
// Videos & Albums
// =========================
if (! function_exists('get_videos')) {
    function get_videos(int $limit = 0)
    {
        $m = new PublikPostModel();
        return $m->get_videos($limit);
    }
}

if (! function_exists('get_albums')) {
    function get_albums(int $limit = 0)
    {
        $photos = new PhotoModel();
        $albumModel = new AlbumModel();

        $albums = $albumModel->where('is_deleted', 'false')->findAll();

        foreach ($albums as &$album) {
            $albumPhotos = $photos
                ->where('photo_album_id', $album['id'])
                ->where('is_deleted', 'false')
                ->findAll($limit);

            $album['photos'] = $albumPhotos;
            $album['total_photos'] = count($albumPhotos);
        }
        return $albums;
    }
}

// =========================
// Menus (nested)
// =========================
if (! function_exists('get_menus')) {
    function get_menus(): array
    {
        $m = new MenusModel();
        return $m->getMenuWithChildren();
    }
}

if (! function_exists('recursive_list')) {
    function recursive_list(array $menus): string
    {
        $nav = '';
        foreach ($menus as $menu) {
            $menuUrl    = $menu['menu_url'] ?? '#';
            $menuType   = $menu['menu_type'] ?? '';
            $menuTarget = $menu['menu_target'] ?? '_self';
            $menuTitle  = $menu['menu_title'] ?? '';

            $url = $menuUrl === '#' ? '#' : base_url($menuUrl);
            if ($menuType === 'links') {
                $url = $menuUrl; // full URL eksternal
            }

            $nav .= '<li>';
            $nav .= '<a href="' . esc($url) . '" target="' . esc($menuTarget) . '">' . strtoupper(esc($menuTitle)) . '</a>';

            $children = $menu['children'] ?? [];
            $subNav = is_array($children) && ! empty($children) ? recursive_list($children) : '';
            if ($subNav) {
                $nav .= '<ul>' . $subNav . '</ul>';
            }
            $nav .= '</li>';
        }
        return $nav;
    }
}

// =========================
// Opening Speech Route
// =========================
if (! function_exists('opening_speech_route')) {
    function opening_speech_route(): string
    {
        $level = (int) (session()->get('school_level') ?? 0);
        if ($level === 5) return 'sambutan-rektor';
        if ($level === 6) return 'sambutan-ketua';
        if ($level === 7) return 'sambutan-direktur';
        return 'sambutan-kepala-sekolah';
    }
}

// =========================
// String helper: strip tags + truncate by word
// =========================
if (! function_exists('strip_tags_truncate')) {
    function strip_tags_truncate(string $string, int $length = 150): string
    {
        $string = strip_tags($string);

        if (mb_strlen($string) <= $length) {
            return $string;
        }

        $truncated = mb_substr($string, 0, $length);
        $lastSpace = mb_strrpos($truncated, ' ');
        if ($lastSpace !== false) {
            $truncated = mb_substr($truncated, 0, $lastSpace);
        }

        return rtrim($truncated) . '...';
    }
}

// =========================
/**
 * Generate tag links from CSV string
 * @param string $tags_string
 * @return string
 */
// =========================
if (! function_exists('generate_tags_links')) {
    function generate_tags_links($tags_string): string
    {
        if (empty($tags_string) || ! is_string($tags_string)) {
            return '';
        }

        $tags = array_filter(array_map('trim', explode(',', $tags_string)));
        if (empty($tags)) {
            return '';
        }

        $links = [];
        foreach ($tags as $tag) {
            // url_title tersedia di helper 'url'
            $tag_slug = url_title($tag, '-', true);
            $links[] = '<a class="hover:underline" href="' . esc(base_url('tags/' . $tag_slug)) . '">' . esc(ucfirst($tag)) . '</a>';
        }

        return implode(', ', $links);
    }
}

if (!function_exists('reading_time')) {
    /**
     * Estimasi waktu membaca artikel
     *
     * @param string $content Konten artikel (HTML atau plain text)
     * @param int $wpm Words per minute (default 200)
     * @return string Waktu baca, misalnya: "2 menit baca"
     */
    function reading_time(string $content, int $wpm = 200): string
    {
        // Hilangkan tag HTML jika ada
        $text = strip_tags($content);

        // Hitung jumlah kata
        $wordCount = str_word_count($text);

        // Hitung waktu baca dalam menit (dibulatkan ke atas)
        $minutes = (int) ceil($wordCount / $wpm);

        // Output yang fleksibel
        return $minutes . ' menit baca';
    }
}
