<?php

namespace App\Models\publik;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    // Soft delete (opsional, sesuaikan dengan struktur DB kamu)
    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';

    protected $allowedFields    = [
        'post_title',
        'post_content',
        'post_image',
        'post_slug',
        'post_counter',
        'post_author',
        'post_type',
        'post_status',
        'post_visibility',
        'post_categories',
        'post_tags',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
        'restored_at',
        'is_deleted', // kamu pakai string 'false' / 'true' di CI3
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

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

    public function get_latest_posts(int $limit = 0): array
    {
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
        $cats = array_filter(array_map('trim', explode(',', $post_categories)));

        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.created_at, x1.post_content, x1.post_image,
                x1.post_slug, x1.post_counter, x2.user_full_name AS post_author
            ", false)
            ->join('users x2', 'x1.post_author = x2.id', 'left')
            ->where('x1.post_type', 'post')
            ->where('x1.post_status', 'publish')
            ->where('x1.is_deleted', 'false')
            ->orderBy('x1.created_at', 'DESC');

        $this->applyPublicOnlyIfGuest($b, 'x1');

        if ($id > 0) $b->where('x1.id !=', $id);

        if (!empty($cats)) {
            $b->groupStart();
            foreach ($cats as $i => $cat) {
                $i === 0
                    ? $b->like('x1.post_categories', $cat)
                    : $b->orLike('x1.post_categories', $cat);
            }
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
                x1.id, x1.post_title, x1.created_at, x1.post_image, x1.post_content,
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

    public function get_another_pages(int $id = 0, int $limit = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select("
                x1.id, x1.post_title, x1.post_content, x1.created_at,
                x1.post_image, x1.post_slug, x2.user_full_name AS post_author,
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

        $b = $this->db->table($this->table)
            ->select('id, post_title, created_at, post_content, post_slug')
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->where('is_deleted', 'false')
            ->orderBy('created_at', 'DESC')
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

        $idLike = '+0+';
        if ($catRow) {
            $idLike = '+' . $catRow['id'] . '+';
        }

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
}
