<?php

namespace App\Models\publik;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table          = 'posts';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields  = [
        'post_title',
        'post_content',
        'post_image',
        'post_author',
        'post_categories',
        'post_type',
        'post_status',
        'post_visibility',
        'post_comment_status',
        'post_slug',
        'post_tags',
        'post_counter',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
        'restored_at',
        'is_deleted'
    ];
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';

    /**
     * Filter posts berdasarkan slug kategori.
     * Asumsi: kolom posts.post_categories berisi CSV ID kategori.
     */
    public function forCategorySlug(string $slug): self
    {
        // Ambil ID kategori (tabel kategorimu bernama 'categories', type='post')
        $cat = $this->db->table('categories')
            ->select('id')
            ->where('category_slug', $slug)
            ->where('category_type', 'post')
            ->where('deleted_at', null)    // jika pakai soft delete
            // ->where('is_deleted', 0)    // jika pakai flag boolean
            ->limit(1)
            ->get()->getRowArray();

        if (!$cat) {
            // Pastikan tidak ada hasil jika kategori tidak ditemukan
            return $this->where('1 =', 0);
        }

        $catId = (int) $cat['id'];

        // Gunakan FIND_IN_SET untuk CSV id kategori
        // Catatan: ini akan menambah WHERE ke builder internal model.
        return $this->where("FIND_IN_SET({$catId}, {$this->table}.post_categories)");
    }

    /** Cek login (mengacu ke session/Library Auth jika ada) */
    protected function isLoggedIn(): bool
    {
        // Jika kamu punya service('auth')->hasLogin()
        if (function_exists('service')) {
            $auth = service('auth');
            if ($auth && method_exists($auth, 'hasLogin')) {
                return $auth->hasLogin();
            }
        }
        return session()->get('has_login') == true;
    }

    /** Tambahkan filter visibility kalau belum login */
    protected function applyPublicOnlyIfGuest($builder, string $alias = 'x1')
    {
        if (! $this->isLoggedIn()) {
            $builder->where("$alias.post_visibility", 'public');
        }
        return $builder;
    }

    /** ====== PORTING FUNGSI-FUNGSI CI3 ====== */
    public function getPostsSlug($slug)
    {
        $builder = $this->db->table($this->table . ' x1');
        $builder->select('
        x1.id,
        x1.post_title,
        x1.post_slug,
        x1.post_type,
        x1.post_content,
        x1.post_tags,
        x1.post_categories,
        x1.post_comment_status,
        x1.post_image,
        x1.post_status,
        x1.post_counter,
        x1.created_at,
        x1.updated_at,
        x1.is_deleted,
        x1.post_type,
        x2.user_full_name AS post_author,
        x2.user_jabatan AS author_jabatan,
        x2.user_bio AS author_bio,
        x2.user_contact AS post_contact,
        x3.category_name,
        x3.category_slug
    ');
        $builder->join('users x2', 'x1.post_author = x2.id', 'left');
        $builder->join('categories x3', 'x1.post_categories = x3.id', 'left');
        $builder->where('x1.is_deleted', 'false');
        $builder->where('x1.post_slug', $slug);

        return $builder->get()->getRowArray();
    }
    public function get_latest_posts(int $limit = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id,
                x1.post_title,
                x1.post_slug,
                x1.post_type,
                x1.post_content,
                x1.post_tags,
                x1.post_categories,
                x1.post_image,
                x1.post_status,
                x1.post_counter,
                x1.created_at,
                x1.updated_at,
                x1.is_deleted,
                x1.post_type,
                x2.user_full_name AS post_author,
                x2.user_jabatan AS author_jabatan,
                x2.user_bio AS author_bio,
                x2.user_contact AS post_contact,
                x3.category_name,
                x3.category_slug
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->join('categories x3', 'x1.post_categories = x3.id', 'left')
            ->whereIn('x1.post_type', ['post', 'page'])
            ->where('x1.post_status', 'publish')
            ->where('x1.post_visibility', 'public')
            ->where('x1.is_deleted', 'false')
            ->orderBy('x1.created_at', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($limit > 0) $b->limit($limit);
        return $b->get()->getResultArray();
    }

    public function get_popular_posts(int $limit = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_content, x1.post_image,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')
            ->orderBy('x1.post_counter', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($limit > 0) $b->limit($limit);
        return $b->get()->getResultArray();
    }

    public function get_most_commented(int $limit = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_content, x1.post_image,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author,
                COUNT(x3.id) AS total_comment
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->join('comments x3', 'x1.id = x3.comment_post_id AND x3.comment_type = "post"', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')
            ->groupBy([
                'x1.id',
                'x1.post_title',
                'x1.created_at',
                'x1.post_content',
                'x1.post_image',
                'x1.post_slug',
                'x1.post_counter',
                'x2.user_full_name'
            ])
            ->having('COUNT(x3.id) >', 0)
            ->orderBy('total_comment', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($limit > 0) $b->limit($limit);
        return $b->get()->getResultArray();
    }

    public function get_random_posts(int $limit = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_content, x1.post_image,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')
            ->orderBy('RAND()', '', false);

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($limit > 0) $b->limit($limit);
        return $b->get()->getResultArray();
    }

    public function get_related_posts(string $post_categories = '', int $id = 0): array
    {
        $catid = $post_categories;

        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_content, x1.post_image,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author, x3.category_name
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->join('categories x3', 'x1.post_categories = x3.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')
            ->orderBy('x1.created_at', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($id > 0) $b->where('x1.id !=', $id);

        if (!empty($catid)) {
            $b->groupStart();
            $b->like('x1.post_categories', $catid);
            $b->groupEnd();
        }

        $limit = (int) (session('post_related_count') ?? 5);
        if ($limit <= 0) $limit = 5;
        $b->limit($limit);

        return $b->get()->getResultArray();
    }

    public function set_post_counter(int $id): bool
    {
        return (bool) $this->db->table($this->table)
            ->set('post_counter', 'post_counter + 1', false)
            ->where($this->primaryKey, $id)
            ->update();
    }

    public function applySearch(string $keyword): self
    {
        $keyword = trim($keyword);

        // pakai alias seperti di query kamu: x1 untuk posts, x2 untuk users
        $this->from($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_image, x1.post_content, x1.post_type,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author
             ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')               // sesuaikan tipe kolom (0/1 atau boolean)
            ->whereIn('x1.post_type', ['post', 'page'])
            ->groupBy('x1.id');;

        if ($keyword !== '') {
            // MySQL/MariaDB: collation *_ci sudah case-insensitive → hindari LOWER()
            $this->groupStart()
                ->like('x1.post_title', $keyword, 'both')
                ->groupEnd();
        } else {
            // Jika q kosong, jangan tampilkan semua data (opsional)
            $this->where('1 = 0', null, false);
        }

        return $this->orderBy('x1.created_at', 'DESC');
    }
    public function applyPostsCategoriesId($id): self
    {

        // pakai alias seperti di query kamu: x1 untuk posts, x2 untuk users
        $this->from($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_image, x1.post_content,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author
             ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')               // sesuaikan tipe kolom (0/1 atau boolean)
            ->whereIn('x1.post_type', ['post'])
            ->groupBy('x1.id');;

        if ($id !== '') {
            // MySQL/MariaDB: collation *_ci sudah case-insensitive → hindari LOWER()
            $this->groupStart()
                ->like('x1.post_categories', $id, 'both')
                ->groupEnd();
        } else {
            // Jika q kosong, jangan tampilkan semua data (opsional)
            $this->where('1 = 0', null, false);
        }

        return $this->orderBy('x1.created_at', 'DESC');
    }
    public function applyPostsTags($tags): self
    {

        // pakai alias seperti di query kamu: x1 untuk posts, x2 untuk users
        $this->from($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_image, x1.post_content,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author
             ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')               // sesuaikan tipe kolom (0/1 atau boolean)
            ->whereIn('x1.post_type', ['post'])
            ->groupBy('x1.id');;

        if ($tags !== '') {
            // MySQL/MariaDB: collation *_ci sudah case-insensitive → hindari LOWER()
            $this->groupStart()
                ->like('x1.post_tags', $tags, 'both')
                ->groupEnd();
        } else {
            // Jika q kosong, jangan tampilkan semua data (opsional)
            $this->where('1 = 0', null, false);
        }

        return $this->orderBy('x1.created_at', 'DESC');
    }


    public function get_years(): array
    {
        $b = $this->db->table($this->table)
            ->select('LEFT(created_at, 4) as year', false)
            ->where('post_type', 'post')
            ->where('is_deleted', 'false')
            ->where('post_status', 'publish')
            ->groupBy('year')
            ->orderBy('year', 'DESC');

        if (! $this->isLoggedIn()) {
            $b->where('post_visibility', 'public');
        }

        return $b->get()->getResultArray();
    }

    public function get_archives($year): array
    {
        $year = (is_numeric($year) && strlen((string)$year) === 4) ? $year : date('Y');

        $b = $this->db->table($this->table . ' x1')
            ->select("
                SUBSTR(x1.created_at, 6, 2) AS code,
                MONTHNAME(x1.created_at) AS month,
                COUNT(*) AS count
            ", false)
            ->where('LEFT(x1.created_at, 4) = ', $year, false)
            ->where('x1.post_type', 'post')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')
            ->groupBy('code, month')
            ->orderBy('code', 'ASC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        return $b->get()->getResultArray();
    }

    public function get_post_archives($year, $month, int $limit = 0, int $offset = 0): array
    {
        $year  = (is_numeric($year) && strlen((string)$year) === 4) ? $year : date('Y');
        $month = str_pad((string)(is_numeric($month) ? (int)$month : 1), 2, '0', STR_PAD_LEFT);

        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_content,
                x1.post_image, x1.post_slug, x1.post_counter,
                x2.user_full_name AS post_author
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')
            ->where('LEFT(x1.created_at, 4) = ', $year, false)
            ->where('SUBSTRING(x1.created_at, 6, 2) = ', $month, false)
            ->orderBy('x1.created_at', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($limit > 0) $b->limit($limit, $offset);
        return $b->get()->getResultArray();
    }

    public function get_post_tags(string $tag = '', int $limit = 0, int $offset = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.post_content, x1.created_at,
                x1.post_image, x1.post_slug, x2.user_full_name AS post_author,
                x1.post_counter
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.is_deleted', 'false')
            ->where('x1.post_status', 'publish')
            ->groupStart()
            ->like("LOWER(REPLACE(x1.post_tags, ' ', '-'))", strtolower($tag), 'both', null, true)
            ->groupEnd()
            ->orderBy('x1.created_at', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($limit > 0) $b->limit($limit, $offset);
        return $b->get()->getResultArray();
    }

    public function get_post_categories(string $category_slug = '', int $limit = 0, int $offset = 0): array
    {
        // Cari ID kategori
        $catRow = $this->db->table('categories')
            ->select('id')
            ->where('category_slug', $category_slug)
            ->where('category_type', 'post')
            ->where('is_deleted', 'false')
            ->limit(1)
            ->get()->getRowArray();
        if (!$catRow || !isset($catRow['id'])) {
            return [];
        }
        $idLike = $catRow['id'];


        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_content,
                x1.post_image, x1.post_slug, x1.post_counter,
                x2.user_full_name AS post_author
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.is_deleted', 'false')
            ->where('x1.post_status', 'publish')
            ->groupStart()
            ->like('x1.post_categories', $idLike)
            ->groupEnd()
            ->orderBy('x1.created_at', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($limit > 0) $b->limit($limit, $offset);
        return $b->get()->getResultArray();
    }


    public function get_another_pages(int $id = 0, int $limit = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.post_content, x1.created_at,
                x1.post_image, x1.post_image, x1.post_slug, x2.user_full_name AS post_author,
                x1.post_counter
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'page')
            ->where('x1.is_deleted', 'false')
            ->where('x1.post_status', 'publish')
            ->orderBy('x1.created_at', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($id > 0) $b->where('x1.id !=', $id);
        if ($limit > 0) $b->limit($limit);
        return $b->get()->getResultArray();
    }

    public function feed(): array
    {
        $limit = (int) (session('post_rss_count') ?? 10);
        if ($limit <= 0) $limit = 10;

        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id,
                x1.post_title,
                x1.post_slug,
                x1.post_type,
                x1.post_content,
                x1.post_tags,
                x1.post_categories,
                x1.post_image,
                x1.post_status,
                x1.post_counter,
                x1.created_at,
                x1.updated_at,
                x1.is_deleted,
                x1.post_type,
                x2.user_full_name AS post_author,
                x2.user_email as author_email,
                x2.user_jabatan AS author_jabatan,
                x2.user_bio AS author_bio,
                x2.user_contact AS post_contact,
                x3.category_name,
                x3.category_slug
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->join('categories x3', 'x1.post_categories = x3.id', 'left')
            ->whereIn('x1.post_type', ['post', 'page'])
            ->where('x1.post_status', 'publish')
            ->where('x1.post_visibility', 'public')
            ->where('x1.is_deleted', 'false')
            ->orderBy('x1.created_at', 'DESC')
            ->limit($limit);

        if (! $this->isLoggedIn()) {
            $b->where('post_visibility', 'public');
        }

        return $b->get()->getResultArray();
    }

    public function getCategoryPost(): array
    {

        $b = $this->db->table('categories')
            ->select('id, category_name, category_slug')
            ->where('category_type', 'post')
            ->where('is_deleted', 'false');

        return $b->get()->getResultArray();
    }

    public function count_post_categories(string $category_slug = ''): int
    {
        // Dapatkan ID kategori
        $catRow = $this->db->table('categories')
            ->select('id')
            ->where('category_slug', $category_slug)
            ->where('category_type', 'post')
            ->where('is_deleted', 'false')
            ->limit(1)
            ->get()->getRowArray();

        $idLike = $catRow['id'];
        // Hitung
        $b = $this->db->table($this->table . ' x1')
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.is_deleted', 'false')
            ->where('x1.post_status', 'publish')
            ->groupStart()
            ->like('x1.post_categories', $idLike)
            ->groupEnd();

        $this->applyPublicOnlyIfGuest($b, 'x1');

        return (int) $b->countAllResults(); // CI4 countAllResults menjalankan query
    }

    public function countPostsPerCategory(): array
    {
        return $this->db->table($this->table . ' x1')
            ->select('x2.id, x2.category_name, x2.category_slug, COUNT(x1.id) as post_count')
            ->join('categories x2', 'x2.id = x1.post_categories')
            ->where('x1.post_type', 'post') // jika ada soft delete
            ->where('x1.post_status', 'publish') // jika ada soft delete
            ->where('x1.post_visibility', 'public') // jika ada soft delete
            ->where('x1.is_deleted', 'false') // jika ada soft delete
            ->where('x2.category_type', 'post') // jika ada soft delete
            ->where('x2.is_deleted', 'false')
            ->groupBy('x2.id')
            ->get()
            ->getResultArray();
    }
    public function get_videos($limit = 0)
    {
        $video = $this->db->table($this->table)
            ->select('id, post_title, post_content, post_slug')
            ->where('post_type', 'video')
            ->where('is_deleted', 'false')
            ->orderBy('created_at', 'DESC');
        if ($limit > 0) $video->limit($limit);
        return $video->get()->getResultArray();
    }
}
